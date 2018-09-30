<div class="x-refs">

    <article class="x-refs__article">{!! trans('home/refs.ref_article') !!}</article>
    <div class="x-refs__bonus">
        <span class="ref-bonus-text">{!! trans('home/refs.referralBonus_span') !!}</span>
        <span class="big-five-span">5.00%</span></div>
    <div class="x-refs__input-container">
        <label for="refLink">{!! trans('home/refs.refLink_label') !!}</label>
        <div class="input-holder">
          <input type="text" name="refLink" id="refLink" readonly="readonly" value="{{url('/').'/?ref='.Auth::user()->token}}">
          <img class="r-copy-click" src="{{ asset('img/copy.png') }}" alt="copy">
        </div>
    </div>
    <div class="x-refs__no-wallet">
      <h3>Please add wallet to participate referral program</h3>
    </div>
    <section class="x-refs__header">
        <div class="x-refs__header_el r-referral">
          {!! trans('home/refs.refReferral_div') !!}
        </div>
        <div class="x-refs__header_el r-bonus">
          {!! trans('home/refs.refBonus_div') !!}
        </div>
    </section>
    @if(isset($data['referrals']['stat']))
        @foreach($data['referrals']['stat'] as $key => $refs)
          @if(isset($refs['token_sum']))
            <section class="x-refs__section">
                <div class="x-refs__section_el r-referral">
                    {{ $key }}
                </div>
                <div class="x-refs__section_el r-bonus">
                    {{ $refs['token_sum'] }} {{ env('TOKEN_NAME') }}
                </div>
            </section>
          @endif
        @endforeach
    @endif

    @if(count($data['referrals']) > 1)
        <section class="x-refs__footer">
            <div class="x-refs__footer_el r-referral">
              {!! trans('home/refs.total_div')  !!}
            </div>
            <div class="x-refs__footer_el r-bonus">
                {{ $data['referrals']['tokens_total'] }} {{ env('TOKEN_NAME') }}
            </div>
        </section>
    @endif

</div>

