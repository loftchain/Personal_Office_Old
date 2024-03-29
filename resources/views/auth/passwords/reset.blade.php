@extends('layouts.app')

@section('content')
  <div class="reset-body">
    <h3>@lang('auth/resetPwd.resetPwd_title')</h3>
    <form id="resetForm"  class="x-form" method="POST" action="{{ route('password.request') }}">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{ $token }}">
      <label for="email" class="email-label">@lang('auth/resetPwd.resetPwdEmail_label')</label>
      <input type="text" name="email" class="my-input email-input" value="{{ Session::get('reset_password_email') }}">
      <div class="error-message error-message0 email reset_email_not_match"></div>

      <label for="password" class="password-label">@lang('auth/resetPwd.createNewPwd_label')</label>
      <input type="password" name="password" class="my-input password-input">
      <div class="error-message error-message1 password not_equal"></div>

      <label for="password_confirmation" class="password-label">@lang('auth/resetPwd.confirmNewPassword_label')</label>
      <input type="password" name="password_confirmation" class="my-input password-input">
      <div class="error-message error-message2 password not_equal"></div>

      <div class="g-recaptcha" data-theme="default" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
      <div class="error-message error-message3 error-message-captcha g-recaptcha-response"></div>
      <button type="submit" class="login-btn modal-btn reusable-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
        @lang('auth/resetPwd.confirmEnter_btn')
      </button>
    </form>
  </div>
@endsection