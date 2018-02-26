<div class="x-wallets__container">
    <p>Я собираюсь инвестировать в:</p>
    <div class="x-wallets__container_buttons">
        <a href="#">Не знаю</a>
        <a href="#">Bitcoin</a>
        <a href="#">Ethereum</a>
    </div>
    <form action="" class="x-wallets__container_form">
        <div>
            <label for="wallet_from">Я собираюсь известировать в Bitcoin с</label>
            <input id="wallet_from" name="wallet_from" type="text">
        </div>
        <div>
            <label for="wallet_to">Я хочу получить токены ERC20 в кошелек</label>
            <input id="wallet_to" name="wallet_to" type="text">
        </div>
    </form>
    <div class="x-wallets__container_text">
        {{--@if(!isset($data['walletFields']['name_of_wallet_invest_from']))--}}
            <p>@lang('home/ico.enter_wallet_to_participate')</p>
        {{--@else--}}
            <p class="appreciate">@lang('home/ico.we_appreciate')</p>
            <p>@lang('home/ico.congrats')</p>
            <ul>
                {{--<li>@lang('home/ico.for_payment_in') {{ $data[' walletFields']['name_of_wallet_invest_from'] }}@lang('home/ico.please_use')<br>{{ env('HOME_WALLET_'.$data['walletFields']['name_of_wallet_invest_from']) }}</li>--}}
                <li>@lang('home/ico.for_payment_in') Ethereum @lang('home/ico.please_use')<br>{{ env('HOME_WALLET_ETH') }}</li>
                <li>@lang('home/ico.set_gas') 199 000</li>
                <li>@lang('home/ico.minimum_payment') 10,05 USD (0,01 ETH или 0,0009 BTC)</li>
                <li>@lang('home/ico.please_do_not') {{ env('MIN_PAY_ETH' ) }} ETH.</li>
                <li>@lang('home/ico.please_ensure')</li>
            </ul>

            <p class="text-center the-one-wallet"> @lang('home/ico.single_wallet') ETH: </p>
            <div class="pay-to-us-wallet">
                <img
                        src="{{ asset('img/qr.png') }}"
                        alt="QR"
                        class="QR-code">
                <p class="wallet-name">0x01adhuih1j2klh78127h8d1g1kj</p>
            </div>
        {{--@endif--}}
    </div>
</div>
