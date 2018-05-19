<div class="x-transaction">
    <h4 class="x-transaction__no-tx-msg">@lang('home/tx.noTxYet_h4')</h4>
    <div class="x-transaction__have-tx-container">
    <section class="x-transaction__desktop">
        <div class="x-transaction__walletContainer"></div>
        <div class="x-transaction__table">
          <div class="x-transaction__table_head">
            <span class="th th-currency">@lang('home/tx.currency_span')</span>
            <span class="th th-to">@lang('home/tx.to_span')</span>
            <span class="th th-status">@lang('home/tx.status_span')</span>
            <span class="th th-info">@lang('home/tx.info_span')</span>
            <span class="th th-date">@lang('home/tx.date_span')</span>
          </div>
          <div class="x-transaction__table_body"></div>
        </div>
    </section>
    <section class="x-transaction__mobile">
        <div class="x-accordion__walletContainer"></div>
        <div class="x-accordion-transaction" id="accordion">
        </div>
    </section>
    </div>
</div>

