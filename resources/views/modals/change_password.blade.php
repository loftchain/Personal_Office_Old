  <div class="modal fade" id="m-ch-pwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">@lang('modals/modals.changePassword_title')</h4>
              </div>
              <form id="changePwdForm" class="x-form"  method="POST" action="{{ route('renew_password') }}">
                      {{ csrf_field() }}
                      <label for="email" class="x-label email-label">@lang('modals/modals.changePasswordCurrent_emailLabel')</label>
                      <input type="email" name="email" class="x-input email-input">
                      <div class="error-message error-message0 email not_your_email"></div>

                      <label for="password1" class="x-label email-label">@lang('modals/modals.changePasswordNew_label')</label>
                      <input type="password" class="x-input" name="password1">
                      <div class="error-message error-message1 password1 pwd_not_match not_equal"></div>

                      <label for="password2" class="x-label email-label">@lang('modals/modals.newPassword_label')</label>
                      <input type="password" class="x-input" name="password2">
                      <div class="error-message error-message2 password2 not_equal"></div>

                      <div class="g-recaptcha" data-theme="default" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                      <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
                  <div class="modal-footer">
                      <button type="submit" class="modal-btn">
                          <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                        @lang('modals/modals.change_btn')
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
