<script>
	String.prototype.trunc = String.prototype.trunc ||
		function (n) {
			return (this.length > n) ? this.substr(0, n - 1) + '&hellip;' : this;
		};

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
		walletTx: $('.x-transaction__walletContainer_wallet'),
		walletTxContainer: $('.x-transaction__walletContainer'),
		acTxContainer: $('.x-accordion__walletContainer'),
		noTxOnWallet: $('.no-tx-yet-msg'),
		walletTxTable: $('.x-transaction__table'),
		walletTxBody: $('.x-transaction__table_body'),
		walletTxHead: $('.x-transaction__table_head'),
		acTransactionContainer: $('.x-accordion-transaction'),
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
					success: data => {
						if (data.length > 0) {
							wa.noTxMessage.hide();
							wa.haveTxContainer.show();
						}
						resolve(data)
					},
					error: data => reject(data)
				});
			});
		},

		renderDesktopTx(data) {
			wa.walletTxContainer.empty();
			wa.walletTxBody.empty();

			return new Promise(function (resolve, reject) {
				data.forEach((item, i) => {

					let tw = data.length > 2 ? item.wallet[0].trunc(15) : item.wallet[0]; //cut wallet button text if there are more than 2 wallets
					let walletHTML = `<a class="x-transaction__walletContainer_wallet" data-toggle="tab" href="#${item.wallet[0]}">(${item.wallet[1]}) ${tw}</a>`;
					let tabSection = `<div id="${item.wallet[0]}" class="x-tab-pane tab-pane fade"></div>`;
					wa.walletTxContainer.prepend(walletHTML);
					wa.walletTxBody.prepend(tabSection);
                    if(item.tx.length > 0){
	                    item.tx.forEach((transaction, i) => {
		                    let infoLink = `https://${transaction.info}/tx/${transaction.transaction_id}`;
		                    let to = transaction.currency === 'ETH' ? '{{ env('HOME_WALLET_ETH') }}' : '{{ env('HOME_WALLET_BTC') }}';
		                    let td = `
                        <div class="td-container">
                            <span class="td td-currency">-${transaction.amount} ${transaction.currency} <br> ${transaction.amount_tokens} {{ env('TOKEN_NAME') }}</span>
                            <span class="td td-to">${to.trunc(10)}</span>
                            <span class="td td-status">${transaction.status}</span>
                            <span class="td td-info"><a href="${infoLink}">${transaction.info}</a></span>
                            <span class="td td-date">${transaction.date}</span>
                        </div>
                        `;

		                    $(`#${item.wallet[0]}`).prepend(td);
	                    })
                    } else {
		                    let noWalletMsg = '<h4 class="no-tx-yet-msg">По данному кошельку транзакций ещё нет</h4>';
		                    $(`#${item.wallet[0]}`).append(noWalletMsg);
                    }

				});
				let walletItem = $('.x-transaction__walletContainer_wallet');
				let tabItem = $('.x-tab-pane');

				walletItem.eq(0).addClass('active');
				tabItem.eq(0).addClass('in active');

				walletItem.each(function () {
					$(this).click(() => {
						walletItem.removeClass('active');
						$(this).addClass('active');
					})
				});

				resolve(data);
				reject(data);
			});
		},

		renderMobileTx(data) {
			return new Promise(function (resolve, reject) {

				data.forEach((item, i) => {

					let tw = data.length > 2 ? item.wallet[0].trunc(15) : item.wallet[0]; //cut wallet button text if there are more than 2 wallets
					let walletHTML = `<a class="x-transaction__walletContainer_wallet-mob" data-toggle="tab" href="#${item.wallet[0]}-mob">(${item.wallet[1]}) ${tw}</a>`;
					let tabSection = `<div id="${item.wallet[0]}-mob" class="mx-tab-pane tab-pane fade"></div>`;

					wa.acTxContainer.prepend(walletHTML);
					wa.acTransactionContainer.prepend(tabSection);
					if(item.tx.length > 0) {
						item.tx.forEach((transaction, i) => {

							let infoLink = `https://${transaction.info}/tx/${transaction.transaction_id}`;
							let to = transaction.currency === 'ETH' ? '{{ env('HOME_WALLET_ETH') }}' : '{{ env('HOME_WALLET_BTC') }}';

							let mobSection = `
                                <button class="accordion">-${transaction.amount} ${transaction.currency} | ${transaction.amount_tokens} {{ env('TOKEN_NAME') }}</button>
                                <div class="panel">
                                    <section>
                                        <span class="mth mth-to">Кому</span>
                                        <span class="mtd mtd-to">${to}</span>
                                    </section>
                                    <section>
                                        <span class="mth mth-status">Статус</span>
                                        <span class="mtd mtd-status td-status">${transaction.status}</span>
                                    </section>
                                    <section>
                                        <span class="mth mth-info">Инфо</span>
                                        <span class="mtd mtd-info"><a href="${infoLink}">${transaction.info}</a></span>
                                    </section>
                                    <section>
                                        <span class="mth mth-date">Дата</span>
                                        <span class="mtd mtd-date">${transaction.date}</span>
                                    </section>
                                </div>
				                `;
							$(`#${item.wallet[0]}-mob`).prepend(mobSection);

						});
					} else {
						let noWalletMsg = '<h4 class="no-tx-yet-msg">По данному кошельку транзакций ещё нет</h4>';
						$(`#${item.wallet[0]}-mob`).append(noWalletMsg);
                    }

				});
				let walletItem = $('.x-transaction__walletContainer_wallet-mob');
				let tabItem = $('.mx-tab-pane');

				walletItem.eq(0).addClass('active');
				tabItem.eq(0).addClass('in active');

				walletItem.each(function () {
					$(this).click(() => {
						walletItem.removeClass('active');
						$(this).addClass('active');
					})
				});

				let acc = document.getElementsByClassName("accordion");

				for (let i = 0; i < acc.length; i++) {
					acc[i].addEventListener("click", function () {
						this.classList.toggle("active");
						let panel = this.nextElementSibling;
						if (panel.style.maxHeight) {
							panel.style.maxHeight = null;
						} else {
							panel.style.maxHeight = panel.scrollHeight + "px";
						}
					});
				}
				resolve(data);
				reject(data);
			});
		},
	};

	//--------------------------------------

	$(document).ready(() => {

		wa.wInput.each(function () {
			wa.editMode($(this));

			if (wa.authenticated) {
				wa.setWallets($(this));
			}
		});

		wa.setTransactions()
			.then((data) => wa.renderDesktopTx(data))
			.then((data) => wa.renderMobileTx(data));
		// 	.then((data) => wa.renderTransactionTemplates(data, wa.desktopObj))
		// 	.then((data) => wa.renderTD(data))
		// 	.then(() => wa.reinitialize());


		wa.submitBtn.each(function () {
			$(this).click(() => {
				setTimeout(() => {
					wa.setTransactions()
						.then((data) => wa.renderDesktopTx(data))
						.then((data) => wa.renderMobileTx(data));
				}, 1500);
			});
		});

		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		});
		setTimeout(() => {
			$('.td-status').each(function (i, el) {
				if ($(this).text() === 'true') {
					$(this).text('success');
					$(this).addClass('status-green');
				} else {
					$(this).text('fail');
					$(this).addClass('status-red');
				}
			});
		}, 1500);

	});
</script>