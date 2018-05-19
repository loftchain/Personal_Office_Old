@extends('layouts.app')

@section('content')

    <main class="w-container">
      <div class="w-container-signUp">
        <a type="button" class="x-register-link" data-toggle="modal" data-target="#m-signUp">
          @lang('home/welcome.signUp_a')
        </a>
      </div>
      <div class="w-container-signIn">
        <a type="button" class="x-login-link" data-toggle="modal" data-target="#m-signIn">
          @lang('home/welcome.signIn_a')
        </a>
        <a type="button" class="x-forgot-link" data-toggle="modal" data-target="#m-forgot">
          @lang('home/welcome.forgotPwd_a')
        </a>
      </div>
    </main>

    @include('modals.register')
    @include('modals.login')
    @include('modals.send_password_reset_emails')
@endsection
