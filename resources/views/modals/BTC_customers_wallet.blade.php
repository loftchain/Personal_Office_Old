<div class="modal fade" id="m-w-BTC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-wallet-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-wallet-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BTC {!! trans('admin/refs.wallet') !!}</h4>
      </div>
      <div class="modal-body modal-wallet-body">
        <img src="{{ asset('img/'. env('HOME_WALLET_BTC') .'.gif') }}" alt="QR" class="QR-code">
        <span class="wallet-name">{{ env('HOME_WALLET_BTC') }}</span>
      </div>
      <div class="modal-footer modal-wallet-footer">
        <a class="modal-btn modal-wallet-copy-btn" data-dismiss="modal">
          {!! trans('modals/modals.copy') !!}
        </a>
      </div>
    </div>
  </div>
</div>
