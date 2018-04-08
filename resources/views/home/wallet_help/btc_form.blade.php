<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form1">
    {{ csrf_field() }}
    <input id="cur1" name="currency" type="hidden" value="BTC">
    <input id="type1" name="type" type="hidden" value="from">
    <label for="wallet1">Я собираюсь известировать в <b>Bitcoin</b> с</label>
    <button class="edit-wallet-btn" type="button"></button>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet1" name="wallet" class="w-input x-input" type="text" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">save</button>
</form>

<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form2">
    {{ csrf_field() }}
    <input id="cur2" name="currency" type="hidden" value="ETH">
    <input id="type2" name="type" type="hidden" value="to">
    <label for="wallet2">Я хочу получить токены <b>ERC20</b> в кошелек <b>ETH</b></label>
    <button class="edit-wallet-btn" type="button"></button>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet2" name="wallet" class="w-input x-input" type="text" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">save</button>
</form>