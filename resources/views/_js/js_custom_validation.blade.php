<script>
  var src = $('.integration-script').attr('src');
  var subOrReg = (/sub/i.test(src)) ? 'subscription' : 'registration';
  var url = new URL(window.location.href);
  var email = url.searchParams.get("email");
  localStorage.setItem('email', email);


  var form = $('form');
  var myInput = $('.my-input');


  myInput.on('input', function () {
    var index = myInput.index($(this));
    if ($(this).is(':valid')) {
      $('.error-message' + index).text('');
      $('.captcha-block').text('');
      $(this).css({'border': 'solid 1px #d0d0d033'});
    }
    if ($(this).value == '') {
      $(this).css({'border': 'solid 1px #d0d0d033'});
    }
  });


  ajax_form = function () {

    $(this).on('submit', function (e) {
      e.preventDefault();


      myInput.css({'border': 'solid 1px #d0d0d033'});
      $(".error-message").html('');

      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: $(this).serialize(),
        dataType: "json",
        success: function (data) {
          $('.fa-spin').hide();
          switch (true) {
            case !$.isEmptyObject(data.validation_error):
              if (data.validation_error['g-recaptcha-response']) {
                data.validation_error['g-recaptcha-response'] = ['{{ __('validation.accepted') }}'];
              }
              $.each(data.validation_error, function (key, value) {
                console.log(data.validation_error);
                if ($(".error-message." + key).prev().hasClass('my-input')) {
                  $(".error-message." + key).prev().css({'border': '1px solid #ff443a'});
                }
                $(".error-message." + key).html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp' + value[0]);
              });
              break;
            case !$.isEmptyObject(data.not_your_email):
            case !$.isEmptyObject(data.not_equal):
            case !$.isEmptyObject(data.pwd_not_match):
            case !$.isEmptyObject(data.is_taken):
            case !$.isEmptyObject(data.failed):
            case !$.isEmptyObject(data.reg_limit_exceeded):
            case !$.isEmptyObject(data.reset_limit_exceeded):
            case !$.isEmptyObject(data.not_confirmed_resend):
            case !$.isEmptyObject(data.invalid_post_service):
            case !$.isEmptyObject(data.smth_went_wrong):
            case !$.isEmptyObject(data.user_not_found):
            case !$.isEmptyObject(data.invalid_send_mail):
            case !$.isEmptyObject(data.invalid_send_reset_mail):
            case !$.isEmptyObject(data.reset_email_not_match):
            case !$.isEmptyObject(data.no_such_user):
            case !$.isEmptyObject(data.already_confirmed):
              $.each(data, function (key, value) {
                $(".error-message." + key).prev().css({'border': '1px solid #ff443a'});
                $(".error-message." + key).html('<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp' + value);
                $('.small-spinner').hide();
              });
              break;
            case !$.isEmptyObject(data.reset_pwd):
              localStorage.setItem('reset_pwd', data.reset_pwd);
              $('.help-block-please-wait').show();
              $("button[type='submit']").prop('disabled', true);
              var redirect_url = '{{ route('root') }}' + '/';
              window.location.replace(redirect_url);
              break;
            case !$.isEmptyObject(data.resend):
              localStorage.setItem('resend', data.resend);
              $(".help-block-reset-pwd").fadeIn(1000, function () {
                $(this).delay(1000).fadeOut(1000);
              });
              redirect_url = '{{ route('root') }}' + '/successRegister?email=' + encodeURIComponent(localStorage.getItem('email'));
              window.location.replace(redirect_url);
              break;
            case !$.isEmptyObject(data.success_register):
              redirect_url = '{{ route('root') }}' + '/successRegister?type=' + subOrReg + '&email=' + encodeURIComponent(data.email);
              window.location.replace(redirect_url); //not used at the moment at qykbar.
              break;
            case !$.isEmptyObject(data.ref_link_added):
            case !$.isEmptyObject(data.ref_link_deleted):
              $('#affiliate_id').val(Math.random().toString(36).substr(2, 10));
              $('#comment').val('');
              $.get('{{ route('root') }}' + '/get_links_view', function (data) {
                $('#refLinks').html(data);
              });
              break;
            case !$.isEmptyObject(data.status) && data.status == 'auth_success':
              redirect_url = '{{ route('root') }}' + '/home';
              window.location.replace(redirect_url);
              break;
            case !$.isEmptyObject(data.admin_confirmed):
              $(".admin-confirmed-text").fadeIn(1000, function () {
                $(this).delay(1000).fadeOut(1000);
              });
              break;
            case !$.isEmptyObject(data.goto2):
              redirect_url = '{{ route('root') }}' + '/agreement2';
              window.location.replace(redirect_url);
              break;
            case !$.isEmptyObject(data.goto3):
              redirect_url = '{{ route('root') }}' + '/home';
              window.location.replace(redirect_url);
              break;
            default:
              $('.help-block-please-wait').show();
              $("button[type='submit']").prop('disabled', true);
              localStorage.setItem('wallet_msg', '{{ __('controller/mycrypto.message_1') }}');
              redirect_url = '{{ route('root') }}' + '/home';
              window.location.replace(redirect_url);
              break;
          }

        },
        error: function (data) {
          console.log(data.errors);
        }
      });

    });

  };

  form.each(ajax_form);

</script>
