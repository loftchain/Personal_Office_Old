<div class="x-wallets__text">
  <ul>
      <li>{!! trans('home/wallet.tnxForParticipate_li') !!}</li>
      @if($currency == 'ETH')
        <li>{!! trans('home/wallet.setGas_li')  !!} 199 000</li>
      @endif
      <li>{!! trans('home/wallet.minimumPayment_li') !!} {{ env('MIN_PAY') }} {{ env('TOKEN_NAME') }}</li>
      <li>{!! trans('home/wallet.maximumPayment_li') !!} {{ env('MAX_PAY') }} {{ env('TOKEN_NAME') }}</li>
  </ul>
  <a type="button" class="x-wallets__text_unified-wallet-button" data-toggle="modal" data-target="#m-w-{{ $currency }}">{!! trans('home/wallet.singleWallet_p') !!}</a>
</div>


