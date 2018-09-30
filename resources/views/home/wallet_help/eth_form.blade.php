<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form0">
    {{ csrf_field() }}
    <input id="cur0" name="currency" class="currency" type="hidden" value="ETH">
    <input id="type0" name="type" class="type" type="hidden" value="from_to">
    <label for="wallet0">{!! trans('home/wallet.eth_label') !!}</label>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet0" name="wallet" class="w-input x-input" type="text" data-currency="ETH" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">{!! trans('home/wallet.save_btn') !!}</button>
</form>

<div class="description-container ETH" data-currency="ETH">
   <p class="no-wallet ETH">{!! trans('home/wallet.addWalletForInvest_p')!!} ETH {!! trans('home/wallet.addWalletForInvest_p_ETH')!!}</p>
</div>


