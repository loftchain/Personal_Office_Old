<div class="modal fade" id="m-forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('auth/password_recovery_send_email.pwd_recovery_title')</h4>
            </div>
            <form id="emailForm" class="x-form"  method="POST" action="{{ route('password.email') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label for="email" class="x-label email-label">@lang('auth/password_recovery_send_email.email_label')</label>
                    <input type="text" name="email" class="x-input email-input user_not_found">
                    <div class="error-message error-message0 email user_not_found failed"></div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    <div class="error-message error-message1 error-message-captcha g-recaptcha-response"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="modal-btn">
                        <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
                        @lang('auth/password_recovery_send_email.send_btn')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>