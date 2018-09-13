@extends('layouts.app')

@section('content')
  <div class="reset-body">
    <h2>@lang('auth/resetPwd.expiredToken_h2')</h2>
    <a href="/" class="login-btn modal-btn reusable-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
      @lang('auth/resetPwd.goBack_button')
    </a>
  </div>
@endsection