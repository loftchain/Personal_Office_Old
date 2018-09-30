<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form1">
    {{ csrf_field() }}
    <input id="cur1" name="currency" class="currency" type="hidden" value="BTC">
    <input id="type1" name="type" class="type" type="hidden" value="from">
    <label for="wallet1">{!! trans('home/wallet.btcInvest_label') !!}</label>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet1" name="wallet" class="w-input x-input" type="text" data-currency="BTC" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">{!! trans('home/wallet.save_btn') !!}</button>
</form>

<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form2">
    {{ csrf_field() }}
    <input id="cur2" name="currency" class="currency" type="hidden" value="ETH">
    <input id="type2" name="type" class="type" type="hidden" value="to">
    <label for="wallet2">{!! trans('home/wallet.btcEthTokenGet_label') !!}</label>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet2" name="wallet" class="w-input x-input" type="text" data-currency="ETH" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">{!! trans('home/wallet.save_btn') !!}</button>
</form>

<div class="description-container BTC" data-currency="BTC">
  <p class="no-wallet BTC">{!! trans('home/wallet.addWalletForInvest_p') !!} BTC & ETH {!! trans('home/wallet.addWalletForInvest_p_nonETH') !!}</p>
</div>
