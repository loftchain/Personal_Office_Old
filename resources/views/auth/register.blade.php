@extends('layouts.app')

@section('content')
    <div class="content-body register-body">
        <h3>@lang('home/register.registration')</h3>
        <form id="registerForm" class="x-form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <label for="email" class="email-label">@lang('home/register.type_your_email')</label>
            <input type="text" name="email" class="my-input email-input">
            @if ($success = Session::get('success'))
                <span class="success-sent help-block-success">
               <i class='fa fa-exclamation-circle fa-2x' asria-hidden='true'></i>
                  <p>{{ $success }}</p>
             </span>
            @endif
            <div class="error-message error-message0 email"></div>
            <label for="password" class="password-label">@lang('home/register.create_password')</label>
            <input type="password" name="password" class="my-input password-input">
            <div class="error-message error-message1 password"></div>
             <div class="success-sent help-block-please-wait">
               <div class="spinner">
                 <div class="rect1"></div>
                 <div class="rect2"></div>
                 <div class="rect3"></div>
                 <div class="rect4"></div>
                 <div class="rect5"></div>
               </div>
               <p>@lang('home/register.please_w8')</p>
             </div>
          <div class="g-recaptcha" data-theme="dark"  data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
          <div class="error-message error-message3 captcha-block g-recaptcha-response"></div>
            <button type="submit" class="register-btn login-btn reusable-btn"> <i class="small-spinner fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i> @lang('home/register.register_btn')  </button>
          <a class="register-on-login" href="{{ route('login') }}"> @lang('home/login.login_btn') </a>
          <input type="hidden" name="hidden" class="my-input password-input">

        </form>

    </div>
    <br><br><br><br><br>
@endsection