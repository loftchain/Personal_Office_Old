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
		errorMessage: $('.error-message'),
		noTxMessage: $('.x-transaction__no-tx-msg'),
		haveTxContainer: $('.x-transaction__have-tx-container'),
		txDesktopContainer: $('.x-transaction_desktop'),
		desktopObj: {
			url: `{{ route('root') }}/getTxDesktopView`,
			name: 'desktop'
		},
		mobileObj: {
			url: `{{ route('root') }}/getTxMobileView`,
			name: 'mobile'
		},

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
				_this.prop('disabled', false);
				setTimeout(() => {
					_this.focus();
				}, 1);
				sbmtBtn.show();
				addBtn.hide();
				_this.val('');
				form.attr('action', '{{ route('store_wallet') }}');
				wa.submitBtn.text('save');
			});

			editBtn.click(() => {
				_this.prop('disabled', false);
				setTimeout(() => {
					_this.focus();
				}, 1);
				sbmtBtn.show();
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
		},

		setTransactions() {
			return new Promise(function (resolve, reject) {
				$.ajax({
					url: '{{ route('getDataForMyTx') }}',
					type: 'GET',
					dataType: 'json',
					success: data => resolve(data),
					error: data => reject(data)
				});
				//    .done(data => {
				// 	wa.haveTxContainer.empty();
				// 	wa.getTxWalletTemplates(data, desktopUrl);
				// 	wa.getTxWalletTemplates(data, mobileUrl);
				// 	wa.setDataToTxView(data);
				// 	console.log(1);
				// }).done(() => {
				// 	wa.reinitialize();
				// 	console.log(3);
				// }).fail(response => {
				// 	wa.ajaxErrorMessage(response)
				// });
			});

		},

		getTxWalletTemplates(data ,urlObj) {
			return new Promise(function (resolve, reject) {
				$.ajax({
					method: "GET",
					url: urlObj.url,
					dataType: 'html',
					success: htmlData => {resolve({mainData:data, htmlData:htmlData}, urlObj)},
					error: data => reject(data)
				});
			});
		},

		renderTxWalletTemplates(data, urlObj) {
			console.log(data, urlObj);
			wa.noTxMessage.remove();
			if (urlObj.name === 'desktop') {
				data.mainData.forEach((transaction, index) => {
					wa.haveTxContainer.append(data.htmlData);
					transaction.tx.forEach((tx, i, arr) => {
						wa.getTdForTable(index, i, tx);
					});
				});
			}
		},

		getTdForTable(index) {
			$.ajax({
				method: "GET",
				url: `{{ route('root') }}/getTdDesktop`,
				dataType: 'html'
			}).done(res => {
				$('.x-transaction_desktop-table-body').get(index).insertAdjacentHTML('beforeend', res);
				console.log('getTdForTable');
			}).fail(data => {
				wa.ajaxErrorMessage(data)
			});
		},

		setDataToTxView(data) {
			setTimeout(() => {
				$('.x-transaction_desktop').each(function (index) {
					$(this).children('.t-form').children('.t-input').val(data[index].wallet);
					$(this).children('.t-form').children('.t-label').text(`#${index + 1} | Транзакции по кошельку : `);
					$(this)
						.children('.x-transaction_desktop-table')
						.children('.x-transaction_desktop-table-body')
						.children('.td-block')
						.each(function (i) {
							let _tx = data[index].tx[i];
							let wallet_to = ``;
							let info = ``;
							let infoHref = ``;

							switch (_tx.currency) {
								case 'ETH':
									wallet_to = `{{ env('HOME_WALLET_ETH') }}`;
									info = `etherscan.io`;
									infoHref = `https://etherscan.io/tx/${_tx.transaction_id}`;
									break;
								case 'BTC':
									wallet_to = `{{ env('HOME_WALLET_BTC') }}`;
									info = `blockchain.info`;
									infoHref = `https://blockchain.info/tx/${_tx.transaction_id}`;
									break;
							}

							$(this).children('.td-value').text(`-${_tx.amount} ${_tx.currency} | ${_tx.amount_tokens} {{ env('TOKEN_NAME') }}`);
							$(this).children('.td-from').text(_tx.from);
							$(this).children('.td-to').text(wallet_to);
							$(this).children('.td-status').text(_tx.status);
							$(this).children('.td-info').children('.td-info-link').text(info);
							$(this).children('.td-info').children('.td-info-link').attr('href', infoHref);
							$(this).children('.td-date').text(_tx.date);
						});
				});

			}, 1000);
		},

		reinitialize() {
			wa.editBtn = $('.edit-wallet-btn');
			wa.addBtn = $('.add-wallet-btn');
			wa.submitBtn = $('.sbmt-wallet-btn');
			wa.wForm = $('.w-form');
			wa.wInput = $('.w-input');

			wa.submitBtn.each(function () {
				$(this).click(() => {
					setTimeout(() => {
						wa.setTransactions();
					}, 1000);
				});
			});

			wa.wInput.each(function () {
				wa.editMode($(this));

				if (wa.authenticated) {
					wa.setWallets($(this));
				}
			});
		}

	};

	//--------------------------------------

	$(document).ready(() => {

		wa.setTransactions()
			.then((data) => wa.getTxWalletTemplates(data, wa.desktopObj))
			.then((data) => wa.renderTxWalletTemplates(data, wa.desktopObj));


		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		});


	});
</script>