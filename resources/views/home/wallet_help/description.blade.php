<?php $stageInfo = app('\App\Services\BonusService')->getStageInfo() ?>

<div class="x-wallets__text">
  <ul>
      <li>@lang('home/wallet.tnxForParticipate_li')</li>
      @if($currency == 'ETH')
        <li>@lang('home/wallet.setGas_li') 199 000</li>
      @endif
      <li>@lang('home/wallet.minimumPayment_li') {{ $stageInfo['minPayment'] }} ETH</li>
  </ul>
  <a type="button" class="x-wallets__text_unified-wallet-button" data-toggle="modal" data-target="#m-w-{{ $currency }}">@lang('home/wallet.singleWallet_p') {{ $currency }}</a>
</div>


