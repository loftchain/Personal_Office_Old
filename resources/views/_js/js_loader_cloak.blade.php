<script>
	$(window).on("load", function() {
		$('.cloak').fadeOut( "slow");

		if (localStorage.getItem('success_login') !== null) {
			v.showNotification('Вы успешно вошли в свой аккаунт', 'success');
			localStorage.removeItem('success_login')
		}

		if (localStorage.getItem('success_reset_pwd') !== null) {
			v.showNotification('Пароль был успешно изменён.', 'success');
			localStorage.removeItem('success_reset_pwd')
		}
	});

	window.addEventListener("orientationchange", function() {
		$('.cloak').fadeOut( "slow");
	}, false);

	window.onresize = function() {
		$('.cloak').fadeOut( "slow");
	};
</script>