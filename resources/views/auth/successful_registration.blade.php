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
    </div>
  </div>
@endsection