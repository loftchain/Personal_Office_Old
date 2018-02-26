  <div class="content-body login-body">
    @if (app('request')->input('token'))
      <h3 style="letter-spacing: 3px; text-transform: none;">@lang('auth.tnx_confirmed_title')</h3>
      @else
      <h3>@lang('home/login.welcome')</h3>
    @endif
    <form id="loginForm" class="x-form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <label for="email" class="email-label">@lang('home/login.email_label')</label>
        <input type="text" name="email" class="my-input email-input " placeholder="example@mail.com" value="{{ isset($email) ? $email : ''  }}">
        @if (app('request')->input('token'))
            <span class="success-sent help-block-success">
               <i class='fa fa-exclamation-circle fa-2x' aria-hidden='true'></i>
                  <p>@lang('auth.is_correct_message')</p>
             </span>
        @endif
      <div class="error-message error-message0 email"></div>
      <label for="password" class="password-label ">@lang('home/login.pwd_label')</label>
      <input type="password" name="password" autofocus class="my-input password-input">
      <div class="error-message error-message1 password pwd_not_match"></div>
      <div class="g-recaptcha" data-theme="dark"  data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
      <div class="error-message error-message3 captcha-block g-recaptcha-response"></div>
      <button type="submit" class="login-btn reusable-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>  @lang('home/login.login_btn')  </button>
      <div class="log-forgot">
        <a class="sign-forgot" href="{{ route('register') }}"> @lang('app.sign_up') </a>
        <a class="sign-forgot" href="{{ route('password.request') }}"> @lang('home/login.forgot_pwd')</a>
      </div>
      <input type="hidden" name="hidden" class="my-input password-input">
      <div class="error-message error-message4 failed reg_limit_exceeded error_while_registration smth_went_wrong invalid_post_service not_confirmed_resend"></div>
    </form>
  </div>
