<script>
	let wa = {
		authenticated: '{{ $data['authenticated'] }}',
		checkboxImg: $('.checkbox-img'),
		switchWalletLink: $('.switch-wallet-link'),
		editBtn: $('.edit-wallet-btn'),
		addBtn: $('.add-wallet-btn'),
		submitBtn: $('.sbmt-wallet-btn'),
		wForm: $('.w-form'),
		wInput: $('.w-input'),
		wInput0: $('#wallet0'),
		wInput1: $('#wallet1'),
		wInput2: $('#wallet2'),
		errorMessage: $('.error-message'),
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
				_this.prop('disabled', false);
				setTimeout(() => {
					_this.focus();
				}, 1);
				sbmtBtn.show();
				addBtn.hide();
				editBtn.hide();
				form.attr('action', '{{ route('store_wallet') }}');
				wa.submitBtn.text('save');
            });

			editBtn.click(() => {
				_this.prop('disabled', false);
				setTimeout(() => {
					_this.focus();
				}, 1);
				sbmtBtn.show();
				addBtn.hide();
				editBtn.hide();
				form.attr('action', '{{ route('edit_wallet') }}');
				wa.submitBtn.text('edit');
			});

			wa.submitBtn.click(() => {
				submitClicked = true;
			});

			_this.focusout(() => {
				setTimeout(() => {
					if (!submitClicked) {
						wa.exitEditMode();
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
			wa.wInput.removeClass('isError');
            if(wa.wInput0.data('status') === 'active'){
	            wa.editBtn.show();
            }
			// wa.wInput.val('');
			wa.errorMessage.html('');
		},


		setWallets() {
			$.ajax({
				url: '{{ route('current_wallets') }}',
				type: 'GET',
				dataType: 'json',
				success: data => {
					wa.setWalletsToInputs(data);
				},
				error: data => {
					console.dir('Error: Something wrong with ajax call ' + data.errors);
				}
			});
		},

		setWalletsToInputs(walletsData) {
			walletsData.currentWallets.forEach(function (item) {
				switch (item.type) {
					case 'from_to':
						if (item.active === '1') {
							wa.wInput0.val(item.wallet);
							wa.wInput0.data("status", "active");
							wa.editBtn.show();

						} else {

						}
						break;
					case 'from':
						if (item.active === '1') {
							wa.wInput1.val(item.wallet);
							wa.wInput1.data("status", "active");
							wa.editBtn.show();
						} else {

						}
						break;
					case 'to':
						if (item.active === '1') {
							wa.wInput2.val(item.wallet);
							wa.wInput2.data("status", "active");
							wa.editBtn.show();
						} else {

						}
						break;
				}
			});
		}
	};

	//--------------------------------------

	$(document).ready(() => {

		if (wa.authenticated) {
			wa.setWallets();
		}

		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		});

		wa.wInput.each(function () {
				wa.editMode($(this));
		});


	});
</script>