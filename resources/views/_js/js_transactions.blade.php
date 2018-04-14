<script>
class Transactions {

	constructor(){

    }
}

$(document).ready(() => {

	wa.switchWalletLink.each(function () {
		$(this).click(() => {
			wa.switchCheckBox($(this));
		})
	});

	wa.wInput.each(function () {
		wa.editMode($(this));

		if (wa.authenticated) {
			wa.setWallets($(this));
		}
	});
});
</script>