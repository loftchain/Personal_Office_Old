<script>
    let v = {
        form: $('form'),
        xInput: $('.x-input'),
        errors: $('.error-message'),
        loaderSpinner: $('.small-spinner'),
        modal: $('.modal'),
        modalBtn: $('.modal-btn'),
        grayBorderColor: '#E0E0E0',
        exclamation: '<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp',

        resetModal: () => {
            v.xInput.removeClass('isError');
            v.errors.text('');
        },

        closeModal: () => {
            v.modal.modal('hide');
            $('.modal-backdrop').remove();
        },

        showNotification: (text, type) => {
            $.notify(text, {
                type: type
            });
        },

        hideSpinner: () => {
            v.loaderSpinner.fadeOut();
        },

        stateSelection: (data, _this) => {
            switch (true) {
                case !$.isEmptyObject(data.validation_error):
                    if (data.validation_error['g-recaptcha-response']) {
                        data.validation_error['g-recaptcha-response'] = ['{{ __('validation.accepted') }}'];
                    }

                    $.each(data.validation_error, (key, value) => {
                        if (_this.children('.error-message.' + key).prev().hasClass('x-input')) {
                            _this.children('.error-message.' + key).prev().addClass('isError');
                        }
                        _this.children('.error-message.' + key).html(v.exclamation + value[0]);

                        if (_this.children().children('.error-message.' + key).prev().hasClass('x-input')) {
                            _this.children().children('.error-message.' + key).prev().addClass('isError');
                        }
                        _this.children().children('.error-message.' + key).html(v.exclamation + value[0]);
                    });
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.not_your_email):
                case !$.isEmptyObject(data.not_equal):
                case !$.isEmptyObject(data.pwd_not_match):
                case !$.isEmptyObject(data.is_taken):
                case !$.isEmptyObject(data.failed):
                case !$.isEmptyObject(data.reg_limit_exceeded):
                case !$.isEmptyObject(data.reset_limit_exceeded):
                case !$.isEmptyObject(data.not_confirmed):
                case !$.isEmptyObject(data.invalid_post_service):
                case !$.isEmptyObject(data.smth_went_wrong):
                case !$.isEmptyObject(data.user_not_found):
                case !$.isEmptyObject(data.invalid_send_mail):
                case !$.isEmptyObject(data.invalid_send_reset_mail):
                case !$.isEmptyObject(data.reset_email_not_match):
                case !$.isEmptyObject(data.no_such_user):
                case !$.isEmptyObject(data.already_confirmed):
                case !$.isEmptyObject(data.already_exists):
                    $.each(data, (key, value) => {
                        _this.children('.error-message.' + key).prev().addClass('isError');
                        _this.children('.error-message.' + key).html(v.exclamation + value);
                    });
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.success_register):
                    window.location.replace("{{ route('root') . '/agreement1' }}");
                    break;
                case !$.isEmptyObject(data.success_login):
                    window.location.replace("{{ route('root') . '/home' }}");
                    localStorage.setItem('success_login', '+');
                    break;
                case !$.isEmptyObject(data.success_reset_email_sent):
                    v.showNotification('@lang('auth/resetPwd.letterSent_js')', 'success');
                    v.closeModal();
                    break;
                case !$.isEmptyObject(data.error_reset_email_sent):
                    v.showNotification('@lang('auth/resetPwd.letterSentError_js')', 'danger');
                    v.closeModal();
                    break;
                case !$.isEmptyObject(data.success_reset_pwd):
                    window.location.replace("{{ route('root') . '/home' }}");
                    localStorage.setItem('success_reset_pwd', '+');
                    break;
                case !$.isEmptyObject(data.success_changed_email):
                    v.closeModal();
                    v.showNotification('@lang('modals/modals.emailChanged_js')', 'success');
                    break;
                case !$.isEmptyObject(data.success_changed_pwd):
                    v.closeModal();
                    v.showNotification('@lang('modals/modals.pwdChanged_js')', 'success');
                    break;
                case !$.isEmptyObject(data.goto2):
                    window.location.replace("{{ route('root') }}");
                    break;
                case !$.isEmptyObject(data.wallet_added):
                    v.showNotification('@lang('home/wallet.added_js')', 'success');
                    if (typeof wa !== 'undefined') {
                        wa.exitEditMode(_this.children('.w-input'));
                        if(_this.children('.type') === 'to' && $('#wallet1').val() > 0){
                            wa.showDescription('BTC');
                        }

                        if(_this.children('.type') === 'from' && $('#wallet2').val() > 0){

                            wa.showDescription(data.currency);
                        }

                        if(_this.children('.type') === 'from_to'){
                            wa.showDescription(data.currency);
                        }

                    }
                    break;
                case !$.isEmptyObject(data.usd_request_sent):
                    v.showNotification('@lang('home/wallet.requestWasSent_js')', 'success');
                    v.hideSpinner();
                    break;
                case !$.isEmptyObject(data.wallet_edited):
                    v.showNotification('@lang('home/wallet.edited_js')', 'success');
                    if (typeof wa !== 'undefined') {
                        wa.exitEditMode(_this.children('.w-input'));
                    }
                    break;
                case !$.isEmptyObject(data.confirmation_complete):
                    v.showNotification('@lang('admin/confirmation.userConfirmed_js')', 'success');
                    break;
                default:
                    console.log('js_custom_validation.blade.php default switch state');
                    break;
            }
        },

        ajax_form: function () {
            $(this).on('submit', function (e) {
                e.preventDefault();
                v.resetModal();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: data => {
                        v.loaderSpinner.hide();
                        v.stateSelection(data, $(this));
                    },

                    error: data => {
                        console.log('Error: Something wrong with ajax call ' + data.errors);
                    }
                });
            });
        }
    };

    v.modal.on('hidden.bs.modal', () => {
        v.resetModal();
    });

    v.modalBtn.on('click', () => {
        v.loaderSpinner.fadeIn('slow');
    });

    v.xInput.on('input', function () {
        if ($(this).is(':valid')) {
            $(this).removeClass('isError');
            $(this).next().html('');
        }
    });

    v.form.each(v.ajax_form);
</script>
