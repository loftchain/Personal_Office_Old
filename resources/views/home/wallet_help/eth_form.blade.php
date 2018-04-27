<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form0">
    {{ csrf_field() }}
    <input id="cur0" name="currency" class="currency" type="hidden" value="ETH">
    <input id="type0" name="type" class="type" type="hidden" value="from_to">
    <label for="wallet0">Я собираюсь известировать в <b>ETH</b> и получать токены на данный кошелёк</label>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet0" name="wallet" class="w-input x-input" type="text" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">save</button>
</form>

<div class="description-container ETH" data-currency="ETH">
    @if(\Illuminate\Support\Facades\Auth::check())
        <p class="no-wallet ETH">Для инвестирования, пожалуйста, добавьте кошелёк ETH</p>
    @else
        <p class="no-wallet ETH">Для участия в программе, пожалуйста, зарегистрируйтесь</p>
    @endif
</div>


