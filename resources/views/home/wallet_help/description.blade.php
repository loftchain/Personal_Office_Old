<?php $stageInfo = app('\App\Services\BonusService')->getStageInfo() ?>

<div class="x-wallets__text">
    <ul>
        <li>@lang('home/wallet.tnxForParticipate_li')</li>
        @if($currency == 'ETH')
          <li>@lang('home/wallet.setGas_li') 199 000</li>
        @endif
        <li>@lang('home/wallet.minimumPayment_li') {{ $stageInfo['minPayment'] }} ETH</li>
        <li>@lang('home/wallet.pleaseDoNot_li')</li>
        <li>@lang('home/wallet.pleaseEnsure_li')</li>
    </ul>
    <p class="the-one-wallet"> @lang('home/wallet.singleWallet_p') {{ $currency }}: </p>
    <div class="pay-to-us-wallet">
        <img
                src="{{ asset('img/'. env('HOME_WALLET_'.$currency) .'.gif') }}"
                alt="QR"
                class="QR-code">
        <span class="wallet-name">{{ $stageInfo['wallet'.$currency] }}</span>
        <img data-currency="{{ $currency }}" class="w-copy-click w-copy-click-{{ $currency }}" src="{{ asset('img/wallet-copy.png') }}" alt="copy">
    </div>
</div>