<script>


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

		ajaxErrorMessage(data) {
			console.log(`Error: Something wrong with ajax call ${data.errors}`);
		},

		switchCheckBox(_this) {
			wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
			_this[0].childNodes[1].childNodes[1].src = '{{ asset('img/checked-checkbox.png') }}';
		},

		editMode(_this) { //input
			const form = _this.parent();
			const sbmtBtn = form.find('.sbmt-wallet-btn');
			const addBtn = form.find('.add-wallet-btn');
			const editBtn = form.find('.edit-wallet-btn');
			let submitClicked = false;

			addBtn.click(() => {
				switch (true) {
					case wa.userConfirmed === '1' && wa.userAuthenticated === '1':
						_this.prop('disabled', false);
						setTimeout(() => {
							_this.focus();
						}, 1);
						sbmtBtn.show();
						addBtn.hide();
						_this.val('');
						break;
					case wa.userConfirmed === '0':
						v.showNotification('Пожалуйста дождитесь подтверждения от админимстратора.');
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
				switch (wallet.type) {
					case 'from':
						if (currency.val() === wallet.currency) {
							_this.val(wallet.wallet);
							wa.showDescription(wallet.currency);
						}
						break;
					default:
						if (type.val() === wallet.type) {
							_this.val(wallet.wallet);
							wa.showDescription(wallet.currency);
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
		}
	};

	//--------------------------------------

	$(document).ready(() => {
		console.log(wa.userAuthenticated);
		wa.wInput.each(function () {
			wa.editMode($(this));

			if (wa.userAuthenticated) {
				wa.setWallets($(this));
			}
		});

		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		});
	});
</script>