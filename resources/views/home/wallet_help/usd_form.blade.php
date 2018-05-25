<form action="{{ route('send_usd_proposal') }}" class="w-form" method="POST" id="form0">
    {{ csrf_field() }}
    <button type="submit">отправить запрос</button>
</form>

<div class="description-container USD" data-currency="USD">
   <p class="no-wallet ETH">@lang('home/wallet.addWalletForInvest_p') USD</p>
</div>


