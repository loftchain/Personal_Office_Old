<script>
	String.prototype.trunc = String.prototype.trunc ||
		function (n) {
			return (this.length > n) ? this.substr(0, n - 1) + '&hellip;' : this;
		};
	let txs = {
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

		changeStatuses() {
			$('.td-status').each(function (i, el) {
				if ($(this).text() === 'true') {
					$(this).text('success');
					$(this).addClass('status-green');
				} else {
					$(this).text('fail');
					$(this).addClass('status-red');
				}
			});
		},

		afterEffects(walletItem, tabItem) {
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
		},

		setTransactions() {
			return new Promise(function (resolve, reject) {
				$.ajax({
					url: '{{ route('getDataForMyTx') }}',
					type: 'GET',
					dataType: 'json',
					success: data => {
						if (data.length > 0) {
							txs.noTxMessage.hide();
							txs.haveTxContainer.show();
						}
						resolve(data)
					},
					error: data => reject(data)
				});
			});
		},

		renderWalletPart(data, item, container1, container2, class1, class2, mob = '') {
			let tw = data.length > 2 ? item.wallet[0].trunc(12) : item.wallet[0]; //cut wallet button text if there are more than 2 wallets
			let walletHTML = `<a class="${class1}" data-toggle="tab" href="#${item.wallet[0]}${mob}">(${item.wallet[1]}) ${tw}</a>`;
			let tabSection = `<div id="${item.wallet[0]}${mob}" class="${class2} tab-pane fade"></div>`;
			container1.prepend(walletHTML);
			container2.prepend(tabSection);
		},

		renderDesktopTxPart(item) {
			if (item.tx.length > 0) {
				item.tx.forEach((transaction) => {
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
		},

		renderDesktopTx(data) {
			txs.walletTxContainer.empty();
			txs.walletTxBody.empty();
			return new Promise(function (resolve, reject) {
				data.forEach((item, i) => {
					txs.renderWalletPart(
						data, item,
						txs.walletTxContainer, txs.walletTxBody,
						`x-transaction__walletContainer_wallet`,
						`x-tab-pane`
					);
					txs.renderDesktopTxPart(item);
				});
				txs.afterEffects($('.x-transaction__walletContainer_wallet'), $('.x-tab-pane'));
				resolve(data);
				reject(data);
			});
		},

		renderMobileTxPart(item) {
			if (item.tx.length > 0) {
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
		},

		renderMobileTx(data) {
			return new Promise(function (resolve, reject) {
				data.forEach((item) => {
					txs.renderWalletPart(
						data, item,
						txs.acTxContainer, txs.acTransactionContainer,
						`x-transaction__walletContainer_wallet-mob`,
						`mx-tab-pane`, `-mob`
					);
					txs.renderMobileTxPart(item);
				});
				txs.afterEffects($('.x-transaction__walletContainer_wallet-mob'), $('.mx-tab-pane'));
				resolve(data);
				reject(data);
			});
		},
	};

	$(document).ready(() => {
		txs.setTransactions()
			.then((data) => txs.renderDesktopTx(data))
			.then((data) => txs.renderMobileTx(data))
			.then(() => txs.changeStatuses())
			.catch(e => {
				console.error(e);
			});

		wa.submitBtn.each(function () {
			$(this).click(() => {
				setTimeout(() => {
					txs.setTransactions()
						.then((data) => txs.renderDesktopTx(data))
						.then((data) => txs.renderMobileTx(data))
						.then(() => txs.changeStatuses())
                        .catch(e => {
						console.error(e);
					});
				}, 1500);
			});
		});

	});
</script>