<script>
	let wa = {
		checkboxImg: $('.checkbox-img'),
		switchWalletLink: $('.switch-wallet-link'),
		editBtn: $('.edit-btn'),
		submitBtn: $('.sbmt-btn'),
		wInput: $('.w-input'),
		switchCheckBox(th) {
			wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
			th[0].childNodes[1].childNodes[1].src = '{{ asset('img/checked-checkbox.png') }}';
		},
    editMode(){
        wa.wInput.prop('disabled', false);
        wa.submitBtn.show();
        wa.editBtn.hide();
        $('.w-input').focus();
    }


	};

	$(document).ready(() => {

		wa.switchWalletLink.each(function () {
			$(this).click(() => {
				wa.switchCheckBox($(this));
			})
		});

    wa.editBtn.click(() => {
        wa.editMode();
    });

	});
</script>