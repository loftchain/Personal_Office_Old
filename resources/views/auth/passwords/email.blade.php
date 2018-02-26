  <div class="content-body email-body">

    <h3>@lang('home/password_recovery_send_email.pwd_recovery_title')</h3>
    <form id="emailForm" class="x-form"  method="POST" action="{{ route('password.email') }}">
      {{ csrf_field() }}

      <label for="email" class="email-label">@lang('home/password_recovery_send_email.email_label')</label>
      <input type="text" name="email" class="my-input email-input">
      <div class="error-message error-message0 email"></div>
      @if (session('status'))
        <div class="success-sent">
          <i class='fa fa-exclamation-circle fa-2x' aria-hidden='true'></i>
          <p>{{ session('status') }}</p>
        </div>
      @endif
      <div class="g-recaptcha" data-theme="dark"  data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
      <div class="error-message error-message3 captcha-block g-recaptcha-response">
        @if ($errors->has('captcha'))
          <i class='fa fa-exclamation-circle fa-lg' aria-hidden='true'></i>&nbsp{{ $errors->first('captcha') }}
        @endif
      </div>
      <button type="submit" class="login-btn reusable-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i> @lang('home/password_recovery_send_email.send_btn')</button>
      <div class="reg-on-log">
        <a class="register-on-login" href="{{ route('register') }}"> @lang('home/login.register_btn') </a>
        <a class="register-on-login" href="{{ route('login') }}"> @lang('home/login.login_btn') </a>
      </div>
      <input type="hidden" name="hidden" class="my-input password-input">
    </form>

    @if ($errors->has('captcha'))
      <span class="help-block captcha-block">
          <i class='fa fa-exclamation-circle fa-lg' aria-hidden='true'></i>&nbsp{{ $errors->first('captcha') }}
      </span>
    @endif
  </div>