  <div class="modal fade" id="m-ch-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">@lang('home/change_email.change_email')</h4>
              </div>
              <form id="changeEmailForm" class="x-form"  method="POST" action="{{ route('reset_email') }}">
                  <div class="modal-body">
                      {{ csrf_field() }}
                      <label for="email1" class="x-label email-label">@lang('home/change_email.current_email')</label>
                      <input type="text" name="email1" class="x-input email-input">
                      <div class="error-message error-message0 email1 not_your_email not_equal"></div>

                      <label for="email2" class="x-label email-label">@lang('home/change_email.new_email')</label>
                      <input type="text" class="x-input" name="email2">
                      <div class="error-message error-message1 email2 not_equal is_taken"></div>

                      <label for="password" class="x-label email-label">@lang('auth/login.pwd_label')</label>
                      <input type="password" class="x-input" name="password">
                      <div class="error-message error-message2 password pwd_not_match"></div>

                      <div class="g-recaptcha"  data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                      <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="modal-btn">
                          <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                          @lang('home/change_password.change_btn')
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>