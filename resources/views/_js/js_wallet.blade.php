<script>
    let wa = {
        checkboxImg: $('.checkbox-img'),
        switchWalletLink: $('.switch-wallet-link'),
        editBtn: $('.edit-btn'),
        submitBtn: $('.sbmt-btn'),
        wInput: $('.w-input'),
        wInput0: $('#wallet_from0'),
        switchCheckBox(_this) {
            wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
            _this[0].childNodes[1].childNodes[1].src = '{{ asset('img/checked-checkbox.png') }}';
        },

        editMode(_this) {
            _this.prop('disabled', false);
            _this.next().next().show();
            _this.prev().hide();
            setTimeout(() => {
                _this.focus();
            }, 1);
        },

        exitEditMode() {
            wa.wInput.prop('disabled', true);
            wa.submitBtn.hide();
            wa.editBtn.show();
        }
    };


    //--------------------------------------


    $(document).ready(() => {

        wa.switchWalletLink.each(function () {
            $(this).click(() => {
                wa.switchCheckBox($(this));
            })
        });

        wa.wInput.each(function () {
            $(this).prev().click(() => {
                wa.editMode($(this));
            });
        });

        wa.wInput.focusout(() => {
            // wa.exitEditMode();
        });

    });
</script>