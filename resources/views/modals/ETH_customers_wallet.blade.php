<div class="modal fade" id="m-w-ETH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-wallet-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-wallet-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">OPN ETH wallet</h4>
            </div>
            <div class="modal-body modal-wallet-body">
              <img src="{{ asset('img/'. env('HOME_WALLET_ETH') .'.gif') }}" alt="QR" class="QR-code">
              <span class="wallet-name">{{ env('HOME_WALLET_ETH') }}</span>
            </div>
            <div class="modal-footer modal-wallet-footer">
              <a class="modal-btn modal-wallet-copy-btn" data-dismiss="modal">
                @lang('modals/modals.copy')
              </a>
            </div>
        </div>
    </div>
</div>
