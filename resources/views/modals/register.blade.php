<div class="modal fade" id="m-signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title success-register">Поздравляем с успешной регистрацией</h4>
                <h4 class="modal-title process-register" id="myModalLabel">@lang('auth/register.registration')</h4>
            </div>
            <form id="registerForm" class="r-form" method="POST" action="{{ route('register') }}">
                <div class="r-modal-body modal-body process-register">
                    {{ csrf_field() }}
                    <label for="email" class="x-label r-label email-label">@lang('auth/register.type_your_email')</label>
                    <input id="email" type="text" name="email" class="x-input email-input">
                    <div class="error-message error-message0 email already_exists"></div>
                    <label for="password" class="x-label r-label password-label">@lang('auth/register.create_password')</label>
                    <input id="password" type="password" name="password" class="x-input password-input">
                    <div class="error-message error-message1 password"></div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="modal-btn process-register">
                      <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                      @lang('auth/register.register_btn')
                  </button>
                </div>
            </form>
        </div>
    </div>
</div>