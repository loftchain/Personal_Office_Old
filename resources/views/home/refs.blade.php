<div class="x-refs">

    <article class="x-refs__article">
        Наш smart-контракт предусматривает реферальную программу.
        За каждую транзакцию пользователя, которого вы пригласите, вы будете получать бонус.
        Все реферальные выплаты начнут производиться в течении 30 дней после завершения основных
        этапов ICO на протяжении 3 месяцев равными долями.
    </article>
    <div class="x-refs__bonus">
        <span class="ref-bonus-text">Реферальный бонус</span>
        <span class="big-five-span">5.00%</span></div>
    <div class="x-refs__input-container">
        <label for="refLink">Ссылка на вашу реферальную программу:</label>
        <input type="text" name="refLink" id="refLink" readonly="readonly" value="{{url('/').'/?ref='.Auth::user()->token}}">
        <img class="r-copy-click" src="{{ asset('img/copy.png') }}" alt="copy">
    </div>
    <section class="x-refs__header">
        <div class="x-refs__header_el r-referral">
            Реферал
        </div>
        <div class="x-refs__header_el r-bonus">
            Мой бонус
        </div>
        <div class="x-refs__header_el r-date">
            Дата
        </div>
    </section>
    <section class="x-refs__section">
        <div class="x-refs__section_el r-referral">
            Nkmelnikov@hotmail.com
        </div>
        <div class="x-refs__section_el r-bonus">
            -12 ETH (0.01 BTC    |   123.1231 tokens)
        </div>
        <div class="x-refs__section_el r-date">
            18.02.2018
        </div>
    </section>

</div>

