<script>
  var v = {
    form: $('form'),
    xInput: $('.x-input'),
    errors: $(".error-message"),
    loaderSpinner: $('.small-spinner'),
    modalBtn: $('.modal-btn'),
    grayBorderColor: '#E0E0E0',
    exclamation: '<i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp',
    resetModal: function () {
      v.xInput.removeClass('isError');
      v.errors.text('');
    },
    errorStateSelection: function (data) {
      switch (true) {
        case !$.isEmptyObject(data.validation_error):
          if (data.validation_error['g-recaptcha-response']) {
            data.validation_error['g-recaptcha-response'] = ['{{ __('validation.accepted') }}'];
          }
          $.each(data.validation_error, function (key, value) {
            if ($(".error-message." + key).prev().hasClass('x-input')) {
              $(".error-message." + key).prev().addClass('isError');
            }
            $(".error-message." + key).html(v.exclamation + value[0]);
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
            $(".error-message." + key).prev().addClass('isError');
            $(".error-message." + key).html(v.exclamation + value);
            v.loaderSpinner.hide();
          });
          break;
        default:

          break;
      }
    },
    ajax_form: function () {
      $(this).on('submit', function (e) {
        e.preventDefault();
        v.resetModal();
        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function (data) {
            v.loaderSpinner.hide();
            v.errorStateSelection(data);
          },
          error: function (data) {
            console.log('Error: Something wrong with ajax call ' + data.errors);
          }
        });
      });
    }
  };

  $('.modal').on('hidden.bs.modal', function () {
      v.resetModal();
  });

  v.modalBtn.on('click', function () {
    v.loaderSpinner.show();
  });

  v.xInput.on('input', function () {
    if ($(this).is(':valid')) {
        $(this).removeClass('isError');
        $(this).next().html('');
    }
  });

  v.form.each(v.ajax_form);

</script>
