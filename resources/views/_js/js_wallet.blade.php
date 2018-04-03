<script>
	let wa = {
		checkboxImg: $('.checkbox-img'),
		switchWalletLink: $('.switch-wallet-link'),
		switchCheckBox(th) {
			wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
			th[0].childNodes[1].childNodes[1].src='{{ asset('img/checked-checkbox.png') }}';
		}
	};

	$(document).ready(() => {


		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		})

	});
</script>