<script>
	String.prototype.trunc = String.prototype.trunc ||
		function (n) {
			return (this.length > n) ? this.substr(0, n - 1) + '&hellip;' : this;
		};
	let ac = {
        isAdmin: `{{ $data['admin'] }}`,

		getUsersInfo() {
			return new Promise(function (resolve, reject) {
				$.ajax({
					url: '{{ route('get_user_info') }}',
					type: 'GET',
					dataType: 'json',
					success: data => {
						resolve(data)
					},
					error: data => reject(data)
				});
			});
		},

		renderUsersView(data) {
			return new Promise(function (resolve, reject) {
				if (data.length > 0) {
					data.forEach((user, index) => {
						let sbmtBtn = `<button type="submit" data-id="${user.id}" class="confirm-user-btn">confirm</button>`;
						let userDom = `
                            <section id="a-w__s${index}" class="a-wrapper__section">
                                <div class="a-wrapper__section_el a-id">${user.id}</div>
                                <div class="a-wrapper__section_el a-email">${user.email}</div>
                                <div class="a-wrapper__section_el a-registered-at">${user.created_at}</div>
                                <div class="a-wrapper__section_el a-ip">${user.ip_token}</div>
                                <div class="a-wrapper__section_el a-name">${user.name_surname}</div>
                                <div class="a-wrapper__section_el a-address">${user.permanent_address}</div>
                                <div class="a-wrapper__section_el a-phone">${user.contact_number}</div>
                                <div class="a-wrapper__section_el a-birth">${user.date_place_birth}</div>
                                <div class="a-wrapper__section_el a-nationality">${user.nationality}</div>
                                <div class="a-wrapper__section_el a-funds">${user.source_of_funds}</div>
                                <div id="docWrap${index}" class="a-wrapper__section_el a-doc-wrapper"></div>
                                <div class="a-wrapper__section_el a-confirmed">${user.confirmed}</div>
                                <div class="a-wrapper__section_el a-confirm-btn"></div>
                            </section>
		                `;

						$(userDom).hide().appendTo('.users-wrapper').fadeIn('slow');

						if (user.confirmed === 0) {
							$(`#a-w__s${index}`).append(sbmtBtn);
						}

						user.doc_img_path.forEach((img, i) => {
							let imgPath = `<a target="_blank" href="${img}">#${i + 1}</a>`;
							$(`#docWrap${index}`).append(imgPath);
						})
					})
				}
				resolve(data);
				reject(data);
			});
		},

		confirmUser() {
			return new Promise(function (resolve, reject) {
				$('.confirm-user-btn').each(function () {
					$(this).click(function () {
						$.ajax({
							url: `{{route('root')}}/admin/confirmation/${$(this).data("id")}`,
							type: 'GET',
							dataType: 'json',
							success: data => {
								$('.users-wrapper').empty();
								ac.getUsersInfo()
									.then((data) => ac.renderUsersView(data))
									.then(() => ac.confirmUser());
							},
							error: data => console.log(data)
						});
					})
				});
				resolve();
				reject();
			});
		}
	};


	$(document).ready(() => {
		if(ac.isAdmin == 1) {
			ac.getUsersInfo()
				.then((data) => ac.renderUsersView(data))
				.then(() => ac.confirmUser());
        }
	});
</script>