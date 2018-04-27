<section class="x-wallets">
  <p class="x-wallets__title">Я собираюсь инвестировать в:</p>
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