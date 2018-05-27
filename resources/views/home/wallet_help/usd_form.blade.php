<article>
  <ul>
    @lang('home/wallet.adminWillCoordinate_article')
  </ul>
</article>

<form action="{{ route('store_wallet') }}" class="w-form" method="POST" id="form3">
  {{ csrf_field() }}
  <input id="cur3" name="currency" class="currency" type="hidden" value="ETH">
  <input id="type3" name="type" class="type" type="hidden" value="to">
  <label for="wallet3">@lang('home/wallet.btcEthTokenGet_label')</label>
  <button class="add-wallet-btn" type="button"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
  <input id="wallet3" name="wallet" class="w-input x-input" type="text" data-status="nonActive" disabled>
  <div class="error-message error-message0 wallet"></div>
  <button class="sbmt-wallet-btn" type="submit">@lang('home/wallet.save_btn')</button>
</form>

<form action="{{ route('send_usd_proposal') }}" class="w-form" method="GET" id="form4">
  {{ csrf_field() }}
  <label for="usdAmount">@lang('home/wallet.usdAmount_label')</label>
  <input id="usdAmount" name="usdAmount" type="number" value="$">
  <div class="dispatch-container">
    <label for="dispatch" class="dispatch-label">@lang('agreement/agreement.agreeWithDispatch_label')</label>
    <input type="checkbox" id="dispatch" class="dispatch-checkbox" name="terms">
  </div>
  <button class="sbmt-usd-amount-btn" type="submit">@lang('home/wallet.sendUsdRequest_btn')</button>
</form>





