<div class="x-refs">

    <article class="x-refs__article">@lang('_home/refs.ref_article')</article>
    <div class="x-refs__bonus">
        <span class="ref-bonus-text">@lang('_home/refs.referralBonus_span')</span>
        <span class="big-five-span">5.00%</span></div>
    <div class="x-refs__input-container">
        <label for="refLink">@lang('_home/refs.refLink_label')</label>
        <div class="input-holder">
          <input type="text" name="refLink" id="refLink" readonly="readonly" value="{{url('/').'/?ref='.Auth::user()->token}}">
          <img class="r-copy-click" src="{{ asset('img/copy.png') }}" alt="copy">
        </div>
    </div>
    <section class="x-refs__header">
        <div class="x-refs__header_el r-referral">
          @lang('_home/refs.refReferral_div')
        </div>
        <div class="x-refs__header_el r-bonus">
          @lang('_home/refs.refBonus_div')
        </div>
    </section>
    @if(isset($data['referrals']['stat']))
        @foreach($data['referrals']['stat'] as $key => $refs)
            <section class="x-refs__section">
                <div class="x-refs__section_el r-referral">
                    {{ $key }}
                </div>
                <div class="x-refs__section_el r-bonus">
                    {{ $refs['token_sum'] }} {{ env('TOKEN_NAME') }}
                </div>
            </section>
        @endforeach
    @endif

    @if(count($data['referrals']) > 1)
        <section class="x-refs__footer">
            <div class="x-refs__footer_el r-referral">
              @lang('_home/refs.total_div')
            </div>
            <div class="x-refs__footer_el r-bonus">
                {{ $data['referrals']['tokens_total'] }} {{ env('TOKEN_NAME') }}
            </div>
        </section>
    @endif

</div>

