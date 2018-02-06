@extends('layouts.app')

@section('content')
  <div class="content-body successful-register-body">

    <div class="resend">
      <p> {!! __('controller/register.pwd_sent') !!}</p>
      <form id="resendForm" method="GET" action="{{ route('resend', ['email' => app('request')->input('email')]) }}">
        <button disabled id="button" type="submit" class="repass-btn-dis"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i> @lang('home/login.repass_btn')

          <span id="timer">59</span>
        </button>
      </form>
      <br>
      <br>
      <input type="hidden" name="hidden" class="my-input password-input">
      <div style="color:#ff443a; width: 265px" class="error-message error-message4 not_confirmed_resend smth_went_wrong invalid_send_mail reset_limit_exceeded invalid_post_service
                  error_while_registration user_not_found invalid_send_reset_mail reg_limit_exceeded error_occured">
      </div>
      <span class="help-block-reset-pwd" style="color:lightseagreen; width: 265px"></span>
    </div>
  </div>
@endsection