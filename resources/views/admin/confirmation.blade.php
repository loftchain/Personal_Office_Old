@extends('layouts.app')

@section('content')

    <div class="content-body admin-body">
        <form id="HiddenConfirmForm" class="x-form" method="POST" action="{{ route('admin.force_confirm') }}">
            {{ csrf_field() }}
            <h3>Admin confirmation</h3>
            <label for="email" class="email-label">Problem User Email</label>
            <input type="text" name="email" class="my-input email-input " placeholder="example@mail.com" value="">
            <div class="error-message error-message0 email already_confirmed no_such_user"></div>
            <label for="password" class="password-label ">Secret password</label>
            <input type="password" name="password" class="my-input password-input">
            <div class="error-message error-message1 password pwd_not_match"></div>
            <button type="submit" class="login-btn reusable-btn">Confirm</button>
            <p class="admin-confirmed-text">
                <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> Confirmed
            </p>
            <input type="hidden" name="hidden" class="my-input password-input">
            <div class="error-message error-message4 failed reg_limit_exceeded error_while_registration smth_went_wrong invalid_post_service not_confirmed_resend"></div>
        </form>
    </div>

@endsection