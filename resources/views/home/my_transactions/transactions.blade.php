@foreach ($data['transactions'] as $trac)
        <div class="transaction-container">
        <section class="float-left-box">
            <div class="box">
                <div class="top-box">
                    <span class="id-span">ID => {{ $trac->transaction_id }}</span>
                </div>
                <div class="bottom-box">
                    <span class="from">{{ $trac->wallet_from }}</span> => <span class="to">{{ $trac->wallet_to }}</span>
                </div>
            </div>
        </section>
        <section class="float-right-box">
             <div class="box">
               <a target="_blank" href="{{ 'https://etherscan.io/tx/' . $trac->transaction_id }}">@lang('home/transactions.info')</a>
             </div>
             <div class="box">{{ $trac->date }}</div>
             <div class="box">
               <span class="value">{{ strtolower($trac->currency) == 'token' ? $trac->amount_tokens : $trac->amount_eth }}</span>
               <span class="currency">{{ strtolower($trac->currency) == 'token' ?  env('TOKEN_NAME')  : $trac->currency }}</span>
             </div>
       </section>
      </div>
@endforeach

<script>

	var transactions_count = '{{ count($data['transactions']) }}';
	var wallet = '{{ $full_name = isset($data['walletFields']["full_name_of_wallet_invest_from"]) ? $data['walletFields']["full_name_of_wallet_invest_from"] : 'Ethereum' }}';
	var mt = document.getElementById("myTokens");
	var noWallets = '{{ __('home/transactions.no_wallets_yet') }}';
	var noTransactions = '{{ __('home/transactions.no_transactions_yet') }}';
	var newSpan = document.createElement('span');
	mt.appendChild(newSpan);

  if(transactions_count === 0 && wallet.length === 0){
	  newSpan.appendChild(document.createTextNode(noWallets));
  } else if (transactions_count <= 0) {
	  newSpan.appendChild(document.createTextNode(noTransactions));
  }


</script>


