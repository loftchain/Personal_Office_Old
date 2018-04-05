<form action="{{ route('store_wallet') }}" method="POST" id="form0">
    {{ csrf_field() }}
    <input id="cur0" name="currency" type="hidden" value="ETH">
    <input id="type0" name="type" type="hidden" value="from_to">
    <label for="wallet0">Я собираюсь известировать в <b>ETH</b> и получать токены на данный кошелёк</label>
    <button class="edit-btn" type="button"></button>
    <input id="wallet0" name="wallet" class="w-input x-input" type="text" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-btn" type="submit">save</button>
</form>
