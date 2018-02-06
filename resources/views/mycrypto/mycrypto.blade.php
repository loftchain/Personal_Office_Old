@extends('layouts.app')

@section('content')
  <div class="content-body mycrypto-body">
    <h3>@lang('home/mycrypto.my_crypto_wallet')</h3>
    @if ($status = Session::get('status'))
      <span class="home-status-message">
            {{ $status }}
        </span>
    @endif

      <form id="mycryptoForm" class="x-form" method="POST" action="{{ route('store_wallet_data') }}">
        {{ csrf_field() }}
        <p class="invest-amount">@lang('home/mycrypto.what_currency')</p>
        <div class="switch-box-container crypto-currency-container">
          <div class="currency0" data-id="dont_know">@lang('home/mycrypto.dont_know')</div>
          <div class="currency1" data-id="ETH">Ethereum (ETH)</div>
          <div class="currency2" data-id="BTC">Bitcoin (BTC)</div>
          <div class="currency3" data-id="LTC">Lightcoin (LTC)</div>
        </div>
          <div class="crypto-inputs-container">
            <label for="wallet_invest_from" class="pay-wallet-label"></label>
            <input id="wallet_invest_from" type="text" class="my-input" name="wallet_invest_from">
            <div class="error-message error-message0 wallet_invest_from"></div>
            <div class="additional-input-container">
              <label for="wallet_get_tokens" class="get-token-wallet">@lang('home/mycrypto.enter_ethereum_get_tokens') @lang('home/mycrypto.exch_not_allowed')</label>
              <input id="wallet_get_tokens" type="text" class="my-input" name="wallet_get_tokens" data-inputmask="9(9)9999">
              <div class="error-message error-message1 wallet_get_tokens"></div>
            </div>
         </div>
        <p class="crypto-warning-message">@lang('home/mycrypto.dont_know_message')</p>
        <div class="mycrypto-btn-container">
          <button type="submit" class="reusable-btn mycrypto-change-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i> @lang('home/mycrypto.save_btn')</button>
          <a href="{{ route('home') }}" type="submit" class="reusable-btn mycrypto-cancel-btn">@lang('home/mycrypto.cancel_btn')</a>
        </div>

       <input type="hidden" name="name_of_wallet_invest_from" id="name_of_wallet_invest_from">
       <input type="hidden" name="ETH" id="ETH">
       <input type="hidden" name="BTC" id="BTC">
       <input type="hidden" name="LTC" id="LTC">
      </form>
    </div>
  <br> <br> <br> <br> <br>
  <br> <br> <br> <br> <br>
@endsection
