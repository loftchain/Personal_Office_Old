<div class="modal fade" id="m-signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-cloak">
        <div class="sk-folding-cube">
          <div class="sk-cube1 sk-cube"></div>
          <div class="sk-cube2 sk-cube"></div>
          <div class="sk-cube4 sk-cube"></div>
          <div class="sk-cube3 sk-cube"></div>
        </div>
      </div>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title success-register">Поздравляем с успешной регистрацией</h4>
                <h4 class="modal-title process-register" id="myModalLabel">@lang('auth/register.registration')</h4>
            </div>
            <div class="success-register modal-body">
              <p> @lang('controller/register.pwd_sent')</p>
            </div>
            <form id="registerForm" class="r-form" method="POST" action="{{ route('register') }}">
                <div class="r-modal-body modal-body process-register">
                    {{ csrf_field() }}
                    <label for="email" class="x-label r-label email-label">@lang('auth/register.type_your_email')</label>
                    <input id="email" type="text" name="email" class="x-input email-input">
                    <div class="error-message error-message0 email"></div>
                    <label for="password" class="x-label r-label password-label">@lang('auth/register.create_password')</label>
                    <input id="password" type="password" name="password" class="x-input password-input">
                    <div class="error-message error-message1 password"></div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
                </div>
                <div class="modal-footer">
                  <div class="success-register">
                    <form id="resendForm" method="GET" action="{{ route('resend', ['email' => app('request')->input('email')]) }}">
                      <button disabled type="submit" class="resend-btn">
                        <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                        @lang('auth/login.repass_btn')
                        <span id="timer">30</span>
                      </button>
                    </form>
                  </div>
                  <button type="submit" class="modal-btn process-register">
                      @lang('auth/register.register_btn')
                  </button>
                </div>
            </form>
        </div>
    </div>
</div>