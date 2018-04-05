<div class="modal fade" id="m-signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('auth/login.welcome')</h4>
            </div>
            <form id="loginForm" class="l-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <label for="email" class="x-label l-label email-label">@lang('auth/login.email_label')</label>
                    <input type="text" name="email" class="x-input email-input " placeholder="example@mail.com" value="">
                    <div class="error-message error-message0 email not_confirmed failed"></div>
                    <label for="password" class="x-label l-label password-label ">@lang('auth/login.pwd_label')</label>
                    <input type="password" name="password" autofocus class="x-input password-input">
                    <div class="error-message error-message1 password pwd_not_match"></div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
                <div class="modal-footer">
                    <button type="submit" class="modal-btn">
                        <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                        @lang('auth/login.login_btn')
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

