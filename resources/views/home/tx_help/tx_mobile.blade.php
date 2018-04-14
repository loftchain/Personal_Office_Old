<section class="x-transaction_mobile">
    <div class="x-ac-transaction" id="accordion">
        <input type="text" value="{{ $transactions['wallet'] }}" disabled>
        <h3>id => {{ $tx['transaction_id'] }}</h3>
        <div>
            <section>
                <span class="title">Валюта</span>
                <span class="value"> -{{ $tx['amount'] }} {{ $tx['currency'] }} | {{$tx['amount_tokens']}} {{ env('TOKEN_NAME') }}</span>
            </section>
            <section>
                <span class="title">От кого</span>
                <span class="value from">{{$tx['from']}}</span>
            </section>
            <section>
                <span class="title">Кому</span>
                <span class="value to">{{ env('HOME_WALLET_'.$tx['currency'])  }}</span>
            </section>
            <section>
                <span class="title">Инфо</span>
                <span class="value info"><a href="{{ $infoLink }}">{{ $infoName }}</a></span>
            </section>
            <section>
                <span class="title">Дата</span>
                <span class="value">{{ $tx['date'] }}</span>
            </section>
        </div>
    </div>
</section>