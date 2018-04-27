<div class="x-wallets__text">
    <ul>
        <li>Благодарим за участие в программе</li>
        @if($currency == 'ETH')
        <li>@lang('home/ico.set_gas') 199 000</li>
        @endif
        <li>@lang('home/ico.minimum_payment') 10,05 USD (0,01 ETH или 0,0009 BTC)</li>
        <li>@lang('home/ico.please_do_not') {{ env('MIN_PAY_'.$currency ) }} {{ $currency }}.</li>
        <li>@lang('home/ico.please_ensure')</li>
    </ul>

    <p class="the-one-wallet"> @lang('home/ico.single_wallet') {{ $currency }}: </p>
    <div class="pay-to-us-wallet">
        <img
                src="{{ asset('img/qr.png') }}"
                alt="QR"
                class="QR-code">
        <span class="wallet-name">{{ env('HOME_WALLET_'.$currency) }}</span>
    </div>
</div>