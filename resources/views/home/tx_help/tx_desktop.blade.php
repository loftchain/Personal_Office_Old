<section class="x-transaction_desktop">
    <form action="{{ route('edit_wallet') }}" class="w-form" method="POST" id="form0">
        {{ csrf_field() }}
        <input id="cur0" name="currency" class="currency" type="hidden" value="ETH">
        <input id="type0" name="type" class="type" type="hidden" value="from_to">
        <label for="wallet0">#{{ $key + 1 }} | Транзакции по кошельку : </label>
        <button class="edit-wallet-btn" type="button"></button>
        <input id="wallet0" name="wallet" class="w-input x-input" type="text" value="{{ $transactions['wallet'] }}" disabled>
        <div class="error-message error-message0 wallet"></div>
        <button class="sbmt-wallet-btn" type="submit">edit</button>
    </form>
    <table class="">
        <tr>
            <th>Валюта</th>
            <th>От кого</th>
            <th>Кому</th>
            <th>Инфо</th>
            <th>Дата</th>
        </tr>
        <tr>
            <td class="value"> -{{ $tx['amount'] }} {{ $tx['currency'] }} | {{$tx['amount_tokens']}} {{ env('TOKEN_NAME') }}</td>
            <td class="from">{{$tx['from']}}</td>
            <td class="to">{{ env('HOME_WALLET_'.$tx['currency'])  }}</td>
            <td class="info"><a href="{{ $infoLink }}">{{ $infoName }}</a></td>
            <td class="date">{{ $tx['date'] }}</td>
        </tr>
    </table>
</section>