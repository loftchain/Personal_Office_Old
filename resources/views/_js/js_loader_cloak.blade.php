<script>
    $(window).on("load", function () {
        $('.cloak').fadeOut("slow");
        // $('body').height($(document).height());
        // $('#x-app').height($(document).height());
        //  $('.x-body').css('height',$(window).height());
        if (localStorage.getItem('success_login') !== null) {
            v.showNotification('Вы успешно вошли в свой аккаунт', 'success');
            localStorage.removeItem('success_login')
        }

        if (localStorage.getItem('success_reset_pwd') !== null) {
            v.showNotification('Пароль был успешно изменён.', 'success');
            localStorage.removeItem('success_reset_pwd')
        }
    });

    window.addEventListener("orientationchange", function () {
        // $('.cloak').fadeOut("slow");
        // $('body').height($(document).height());
        // $('#x-app').height($(document).height());

    }, false);

    window.onresize = function () {
        // $('.cloak').fadeOut("slow");
        // $('body').height($(document).height());
        // $('#x-app').height($(document).height());

    };
</script>