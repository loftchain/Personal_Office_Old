<script>
	// var seconds = 59;
	var v = {
		form: $('form'),
		xInput: $('.x-input'),
		errors: $('.error-message'),
		loaderSpinner: $('.small-spinner'),
		modalBtn: $('.modal-btn'),
		timer: $('#timer'),
		grayBorderColor: '#E0E0E0',
		exclamation: '<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp',
		resetModal: function () {
			v.xInput.removeClass('isError');
			v.errors.text('');
		},
		closeModal: function () {
			$('.modal').modal('hide');
			$('.modal-backdrop').remove();
		},
		showNotification: function (text, type) {
			$.notify(text, {
				type: type
			});
		},
		hideCloak: function () {
			$('.modal-cloak').fadeOut();
		},
		hideSpinner: function () {
			v.loaderSpinner.fadeOut();
		},
		successRegisterChangeState: function () {
			$('.process-register').hide();
			$('.success-register').show();
			$('.modal-cloak').fadeOut('slow');
		},
		stateSelection: function (data) {
			console.log(data);
			switch (true) {
				case !$.isEmptyObject(data.validation_error):
					if (data.validation_error['g-recaptcha-response']) {
						data.validation_error['g-recaptcha-response'] = ['{{ __('validation.accepted') }}'];
					}
					$.each(data.validation_error, function (key, value) {
						if ($('.error-message.' + key).prev().hasClass('x-input')) {
							$('.error-message.' + key).prev().addClass('isError');
						}
						$('.error-message.' + key).html(v.exclamation + value[0]);
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
					$.each(data, function (key, value) {
						$('.error-message.' + key).prev().addClass('isError');
						$('.error-message.' + key).html(v.exclamation + value);
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
					v.showNotification('На Ваш адрес было отправлено письмо с дальнейшими инструкциями по восстановлению пароля.');
					v.closeModal();
					break;
				case !$.isEmptyObject(data.success_reset_pwd):
					window.location.replace("{{ route('root') . '/home' }}");
					localStorage.setItem('success_reset_pwd', '+');
					break;
				case !$.isEmptyObject(data.success_changed_email):
					v.closeModal();
					v.showNotification('Email был успешно изменён.','success');
					break;
				case !$.isEmptyObject(data.success_changed_pwd):
					v.closeModal();
					v.showNotification('Пароль был успешно изменён.','success');
					break;
				case !$.isEmptyObject(data.goto2):
					window.location.replace("{{ route('root') . '/agreement2' }}");
					break;
				case !$.isEmptyObject(data.goto3):
					window.location.replace("{{ route('root') }}");
					break;
				default:

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
					success: function (data) {
						v.loaderSpinner.hide();
						v.stateSelection(data);
					},
					error: function (data) {
						console.log('Error: Something wrong with ajax call ' + data.errors);
					}
				});
			});
		}
	};

	$('.modal').on('hidden.bs.modal', function () {
		v.resetModal();
	});

	v.modalBtn.on('click', function () {
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
