<section class="x-wallets">
  <p class="x-wallets__title">@lang('_home/wallet.goingToInvest_p')</p>
  <div class="x-wallets__buttons nav nav-tabs">
      <a class="switch-wallet-link BTC" data-toggle="tab" href="#ETH">
          <div class="button">
              <img class="checkbox-img" src="{{ asset('img/checked-checkbox.png') }}" alt="">
              <span>Ethereum (ETH)</span>
          </div>
      </a>
      <a class="switch-wallet-link ETH" data-toggle="tab" href="#BTC">
          <div class="button">
              <img class="checkbox-img" src="{{ asset('img/empty-checkbox.png') }}" alt="">
              <span>Bitcoin (BTC)</span>
          </div>
      </a>
  </div>
  <div class="x-wallets__form">

      <div id="ETH" class="tab-pane fade in active">
          @include('home.wallet_help.eth_form')
      </div>
      <div id="BTC" class="tab-pane fade">
          @include('home.wallet_help.btc_form')
      </div>

  </div>
</section>

@push('scripts')
    @if(!\Illuminate\Support\Facades\Auth::check())
        <script>
            $('.switch-wallet-link').each(function () {
                $(this).click(() => {
                    $('.checkbox-img').attr('src', '{{ asset('img/empty-checkbox.png') }}');
                    $(this)[0].childNodes[1].childNodes[1].src = '{{ asset('img/checked-checkbox.png') }}';
                })
            });

            $('.add-wallet-btn').click(() => {
                $.notify('{{ __('_home/wallet.regToParticipate_js') }}', {
                    type: 'info'
                });
            });
        </script>
    @endif
@endpush
