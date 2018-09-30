<script>
    String.prototype.trunc = String.prototype.trunc ||
        function (n) {
            return (this.length > n) ? this.substr(0, n - 1) + '...' : this;
        };
    let wa = {
        userAuthenticated: '{{ $data['authenticated'] }}',
        userConfirmed: '{{ $data['confirmed'] }}',
        checkboxImg: $('.checkbox-img'),
        switchWalletLink: $('.switch-wallet-link'),
        editBtn: $('.edit-wallet-btn'),
        addBtn: $('.add-wallet-btn'),
        submitBtn: $('.sbmt-wallet-btn'),
        wForm: $('.w-form'),
        wInput: $('.w-input'),
        errorMessage: $('.error-message'),
        wallet3_input: $('#wallet3'),
        usdAmount_input: $('#usdAmount'),
        sendUsdRequest_btn: $('.sbmt-usd-amount-btn'),
        dispatch_checkbox: $('.dispatch-checkbox'),
        loaderSpinner: $('.small-spinner'),

        copyToClipboard(_this) {
            let walletName = _this.parent().prev().children('.wallet-name');
            $(".modal-dialog").append($(`<input class="temp-input" value="${walletName.text()}">`));
            let id = _this.parent().parent().parent().parent().prop('id');
            console.log(id);
            let temp = $('.temp-input');
            temp.select();
            document.execCommand("copy");
            temp.remove();
        },

        ajaxErrorMessage(data) {
            console.log(`Error: Something wrong with ajax call ${data.errors}`);
        },

        switchCheckBox(_this) {
            wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
            $(_this).children('.button').children('.checkbox-img').prop('src', '{{ asset('img/checked-checkbox.png') }}');
        },

        editMode(_this) { //input
            const form = _this.parent();
            const sbmtBtn = form.find('.sbmt-wallet-btn');
            const addBtn = form.find('.add-wallet-btn');
            const editBtn = form.find('.edit-wallet-btn');
            let submitClicked = false;

            addBtn.click(() => {
                switch (true) {
                    case Date.now() < w.startDate_preSale * 1000:
                        v.showNotification('{!! trans('home/wallet.waitUntilStart_js') !!}');
                        break;
                    case wa.userAuthenticated === '1':
                        _this.prop('disabled', false);
                        setTimeout(() => {
                            _this.focus();
                        }, 1);
                        sbmtBtn.show();
                        addBtn.hide();
                        _this.val('');
                        break;
                }
            });

            wa.submitBtn.click(() => {
                submitClicked = true;
            });

            _this.focusout(() => {
                setTimeout(() => {
                    if (!submitClicked) {
                        wa.exitEditMode(_this);
                    } else {
                        submitClicked = false;
                    }
                }, 150);
            });
        },

        exitEditMode(_this) {
            wa.wInput.prop('disabled', true);
            wa.submitBtn.hide();
            wa.addBtn.show();
            wa.editBtn.show();
            wa.wInput.removeClass('isError');
            wa.errorMessage.html('');
            wa.setWallets(_this);
        },

        setWallets(_this) {
            $.ajax({
                url: '{{ route('current_wallets') }}',
                type: 'GET',
                dataType: 'json',
                success: data => {
                    wa.setWalletsToInputs(data, _this);
                },
                error: data => {
                    wa.ajaxErrorMessage(data);
                }
            });
        },

        setWalletsToInputs(walletsData, _this) {
            const form = _this.parent();
            const currency = form.find('.currency');
            const type = form.find('.type');
            walletsData.currentWallets.forEach(function (wallet) {
                let wallet_val = ($(window).width() > 555) ? wallet.wallet : wallet.wallet.trunc(20);

                switch (wallet.type) {
                    case 'from':
                        if (currency.val() === wallet.currency) {
                            _this.val(wallet_val);
                            if($('#wallet2').val().length > 0){
                                wa.showDescription('BTC');
                            }
                        }
                        break;
                    default:
                        if (type.val() === wallet.type) {

                            if(wallet.type === 'from_to'){
                                _this.val(wallet_val);
                                wa.showDescription(wallet.currency);
                            }

                            if(wallet.type === 'to'){
                                _this.val(wallet_val);
                                if($('#wallet1').val().length > 0){
                                    wa.showDescription('BTC');
                                }
                            }

                        }
                        break;
                }
            });
        },

        showDescription(currency) {
            const descriptionContainer = $(`.description-container.${currency}`);
            const noWalletMessage = $(`.no-wallet.${currency}`);
            $.ajax({
                method: "GET",
                url: `{{ route('root') }}/description_view/${currency}`,
                dataType: 'html',
                success: res => {
                    noWalletMessage.remove();
                    if (!$.trim(descriptionContainer.html()).length) {    //if description container is empty
                        descriptionContainer.hide().html(res).fadeIn('slow');
                    }
                },
                error: data => {
                    wa.ajaxErrorMessage(data)
                }
            });
        },

        sendRequestControl() {
            if (!wa.wallet3_input.val() || !wa.usdAmount_input.val() || !wa.dispatch_checkbox.is(':checked')) {
                wa.sendUsdRequest_btn.prop('disabled', true);
            }

            wa.wallet3_input.on('input', () => {
                if (wa.wallet3_input.val().length > 0 && wa.usdAmount_input.val().length > 0 && wa.dispatch_checkbox.is(':checked')) {
                    wa.sendUsdRequest_btn.prop('disabled', false);
                } else {
                    wa.sendUsdRequest_btn.prop('disabled', true);
                }
            });

            wa.usdAmount_input.on('input', () => {
                if (wa.wallet3_input.val().length > 0 && wa.usdAmount_input.val().length > 0 && wa.dispatch_checkbox.is(':checked')) {
                    wa.sendUsdRequest_btn.prop('disabled', false);
                } else {
                    wa.sendUsdRequest_btn.prop('disabled', true);
                }
            });

            wa.dispatch_checkbox.change(function () {
                if (wa.wallet3_input.val().length > 0 && wa.usdAmount_input.val().length > 0 && wa.dispatch_checkbox.is(':checked')) {
                    wa.sendUsdRequest_btn.prop('disabled', false);
                } else {
                    wa.sendUsdRequest_btn.prop('disabled', true);
                }
            });
        }
    };

    //--------------------------------------

    $(document).ready(() => {
        wa.wInput.each(function () {
            wa.editMode($(this));

            if (wa.userConfirmed) {
                wa.setWallets($(this));
            }
        });

        wa.switchWalletLink.each(function () {
            $(this).click(() => {
                wa.switchCheckBox($(this));
            })
        });

        wa.sendUsdRequest_btn.click(() => {
          wa.loaderSpinner.fadeIn('slow');
        });
    });

    $(window).on('load', () => {


        wa.sendRequestControl();

        wa.wCopyImg = $('.modal-wallet-copy-btn');

        wa.wCopyImg.each(function () {
            $(this).click(() => {
                wa.copyToClipboard($(this));
                $.notify('{!! trans('home/wallet.walletCopied_js')  !!}', 'success');
            });
        });
    });


</script>