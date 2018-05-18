<?php $stageInfo = app('\App\Services\BonusService')->getStageInfo() ?>

<div class="x-wallets__text">
    <ul>
        <li>@lang('_home/wallet.tnxForParticipate_li')</li>
        @if($currency == 'ETH')
          <li>@lang('_home/wallet.setGas_li') 199 000</li>
        @endif
        <li>@lang('_home/wallet.minimumPayment_li') {{ $stageInfo['minPayment'] }} ETH</li>
        <li>@lang('_home/wallet.pleaseDoNot_li')</li>
        <li>@lang('_home/wallet.pleaseEnsure_li')</li>
    </ul>
    <p class="the-one-wallet"> @lang('_home/wallet.singleWallet_p') {{ $currency }}: </p>
    <div class="pay-to-us-wallet">
        <img
                src="{{ asset('img/qr.png') }}"
                alt="QR"
                class="QR-code">
        <span class="wallet-name">{{ $stageInfo['wallet'.$currency] }}</span>
    </div>
</div>