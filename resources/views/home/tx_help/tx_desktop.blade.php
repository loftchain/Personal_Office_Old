<section class="x-transaction_desktop">
    <form action="{{ route('edit_wallet') }}" class="w-form t-form" method="POST">
        {{ csrf_field() }}
        <input name="currency" class="currency" type="hidden" value="ETH">
        <input name="type" class="type" type="hidden" value="from_to">
        <label class="t-label" for="wallet-e"># | Транзакции по кошельку : </label>
        <button class="edit-wallet-btn" type="button"></button>
        <input name="wallet" class="w-input x-input t-input" type="text" value="" disabled>
        <div class="error-message error-message0 wallet"></div>
        <button class="sbmt-wallet-btn" type="submit">edit</button>
    </form>
    <table class="x-transaction_desktop-table">
        <thead>
        <tr>
            <th>Валюта</th>
            <th>От кого</th>
            <th>Кому</th>
            <th>Статус</th>
            <th>Инфо</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody class="x-transaction_desktop-table-body">
            {{--<p class="noTD">На данный момент транзакций по этому кошельку нет</p>--}}
        </tbody>

    </table>
</section>
