<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form0">
    {{ csrf_field() }}
    <input id="cur0" name="currency" class="currency" type="hidden" value="ETH">
    <input id="type0" name="type" class="type" type="hidden" value="from_to">
    <label for="wallet0">Я собираюсь известировать в <b>ETH</b> и получать токены на данный кошелёк</label>
    <button class="edit-wallet-btn" type="button"></button>
    <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
    <input id="wallet0" name="wallet" class="w-input x-input" type="text" data-status="nonActive" disabled>
    <div class="error-message error-message0 wallet"></div>
    <button class="sbmt-wallet-btn" type="submit">save</button>
</form>

<div class="description-container">
    @if (count($data['wallets']) > 0)
        @foreach($data['wallets'] as $k => $w)
            @if($w['type'] == 'from_to' && $w['currency'] == 'ETH')
                @include('home.wallet_help.description', ['currency' => 'ETH'])
                @break
            @else
                <p class="x-wallets__form_title">Для инвестирования в ETH, пожалуйста, добавьте кошелёк</p>
            @endif
        @endforeach
    @else
        <p class="x-wallets__form_title">Для инвестирования в ETH, пожалуйста, добавьте кошелёк</p>
    @endif
</div>


