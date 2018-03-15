<section class="x-wallets">
        <p class="x-wallets__title">Я собираюсь инвестировать в:</p>
        <div class="x-wallets__buttons">

            <div class="button">
                <img src="{{ asset('img/checked-checkbox.png') }}" alt="">
                <span>Bitcoin (BTC)</span>
            </div>
            <div class="button">
                <img src="{{ asset('img/empty-checkbox.png') }}" alt="">
                <span>Ethereum (ETH)</span>
            </div>
            <div class="button">
                <img src="{{ asset('img/empty-checkbox.png') }}" alt="">
                <span>Выберу позже</span>
            </div>

        </div>
        <div class="x-wallets__form">
            <p class="x-wallets__form_title">@lang('home/ico.enter_wallet_to_participate')</p>

            <form action="" id="form1">
                    <label for="wallet_from">Я собираюсь известировать в Bitcoin с</label>
                    <input id="wallet_from" name="wallet_from" type="text">
            </form>

            <form action="" id="form2">
                    <label for="wallet_to">Я хочу получить токены ERC20 в кошелек</label>
                    <input id="wallet_to" name="wallet_to" type="text">
            </form>
        </div>
        <div class="x-wallets__text">
                <ul>
                    <li>@lang('home/ico.set_gas') 199 000</li>
                    <li>@lang('home/ico.minimum_payment') 10,05 USD (0,01 ETH или 0,0009 BTC)</li>
                    <li>@lang('home/ico.please_do_not') {{ env('MIN_PAY_ETH' ) }} ETH.</li>
                    <li>@lang('home/ico.please_ensure')</li>
                </ul>

                <p class="the-one-wallet"> @lang('home/ico.single_wallet') ETH: </p>
                <div class="pay-to-us-wallet">
                    <img
                            src="{{ asset('img/qr.png') }}"
                            alt="QR"
                            class="QR-code">
                    <span class="wallet-name">{{ env('HOME_WALLET_ETH') }}</span>
                </div>
        </div>
</section>