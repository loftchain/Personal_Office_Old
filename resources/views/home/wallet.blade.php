<section class="x-wallets">
  <p class="x-wallets__title">Я собираюсь инвестировать в:</p>
  <div class="x-wallets__buttons nav nav-tabs">
      <a class="switch-wallet-link" data-toggle="tab" href="#ETH">
          <div class="button">
              <img class="checkbox-img" src="{{ asset('img/checked-checkbox.png') }}" alt="">
              <span>Ethereum (ETH)</span>
          </div>
      </a>
      <a class="switch-wallet-link" data-toggle="tab" href="#BTC">
          <div class="button">
              <img class="checkbox-img" src="{{ asset('img/empty-checkbox.png') }}" alt="">
              <span>Bitcoin (BTC)</span>
          </div>
      </a>
      <a class="switch-wallet-link" data-toggle="tab" href="#later">
          <div class="button">
              <img class="checkbox-img" src="{{ asset('img/empty-checkbox.png') }}" alt="">
              <span>Выберу позже</span>
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
      <div id="later" class="tab-pane fade">
          @include('home.wallet_help.later')
      </div>

  </div>
  {{--<div class="x-wallets__text">--}}
      {{--<p class="x-wallets__form_title">@lang('home/ico.enter_wallet_to_participate')</p>--}}

      {{--<ul>--}}
              {{--<li>@lang('home/ico.set_gas') 199 000</li>--}}
              {{--<li>@lang('home/ico.minimum_payment') 10,05 USD (0,01 ETH или 0,0009 BTC)</li>--}}
              {{--<li>@lang('home/ico.please_do_not') {{ env('MIN_PAY_ETH' ) }} ETH.</li>--}}
              {{--<li>@lang('home/ico.please_ensure')</li>--}}
          {{--</ul>--}}

          {{--<p class="the-one-wallet"> @lang('home/ico.single_wallet') ETH: </p>--}}
          {{--<div class="pay-to-us-wallet">--}}
              {{--<img--}}
                      {{--src="{{ asset('img/qr.png') }}"--}}
                      {{--alt="QR"--}}
                      {{--class="QR-code">--}}
              {{--<span class="wallet-name">{{ env('HOME_WALLET_ETH') }}</span>--}}
          {{--</div>--}}
{{--</div>--}}
</section>