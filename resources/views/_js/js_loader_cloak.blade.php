<script>
    $(window).on("load", function () {
        $('.cloak').fadeOut("slow");
        if (localStorage.getItem('success_login') !== null) {
            v.showNotification('{!! trans('home/welcome.uLoggedIn_js') !!}', 'success');
            localStorage.removeItem('success_login')
        }

        if (localStorage.getItem('success_reset_pwd') !== null) {
            v.showNotification('{!! trans('home/welcome.pwdHasChanged_js') !!}', 'success');
            localStorage.removeItem('success_reset_pwd')
        }
    });

    window.addEventListener("orientationchange", function () {

    }, false);

    window.onresize = function () {

    };
</script>