<div class="x-transaction">
    {{--<h4 class="x-transaction__no-tx-msg">На данный момент нет ни одной транзакации. Пожалуйста, введите кошелёк.</h4>--}}
    <div class="x-transaction__have-tx-container">
      <section class="x-transaction__desktop">
        <div class="x-transaction__walletContainer">
          <a class="x-transaction__walletContainer_wallet active" data-toggle="tab" href="#0x00123123njksdf">(ETH) 0xa039aff9e49...</a>
          <a class="x-transaction__walletContainer_wallet" data-toggle="tab" href="#0x00123123njksdf">(ETH) 0xa039aff9e49...</a>
        </div>
        <div class="x-transaction__table">
          <div class="x-transaction__table_head">
            <span class="th-currency">Валюта</span>
            <span class="th-to">Кому</span>
            <span class="th-status">Статус</span>
            <span class="th-info">Инфо</span>
            <span class="th-date">Дата</span>
          </div>
          <div class="x-transaction__table_body">
            <div id="0x00123123njksdf" class="tab-pane fade in active">
              @include('home.tx_help.td_desktop')
            </div>
            <div id="0x00123123njks23f" class="tab-pane fade">
              @include('home.tx_help.td_desktop')
            </div>
          </div>
        </div>

      </section>
    </div>
</div>

