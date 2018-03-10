<section class="x-dashboard">
    @if (Auth::check())
        <div class="x-dashboard__info">
            <span class="x-dashboard__info_who"> @lang('home/home.logged_in_as'): {{ obfuscate_email('nkt.millers+test@email.com') }}</span>
            <span class="x-dashboard__info_tokens">12.212312 TOK</span>
        </div>
        <div class="x-dashboard__tabs">
            <ul class="nav nav-tabs">
                <li class="active"> <a data-toggle="tab" href="#home">@lang('home/home.token_sale')</a> </li>
                <li> <a data-toggle="tab" href="#transactions">@lang('home/home.my_transactions')</a> </li>
            </ul>
        </div>
        <div class="x-dashboard__options">
            <a href="{{ route('logout') }}" class="x-dashboard__options_out"><img src="{{ asset('img/logout.png') }}" alt="logout">@lang('home/home.log_out')</a>
            <a type="button" class="x-dashboard__options_email" data-toggle="modal" data-target="#m-ch-email">@lang('home/home.change_email')</a>
            <a type="button" class="x-dashboard__options_password" data-toggle="modal" data-target="#m-ch-pwd">@lang('home/home.change_password')</a>
        </div>
    @else
        <div class="x-dashboard__guest">
            <a type="button" class="x-register-link" data-toggle="modal" data-target="#m-signUp">
                @lang('app.sign_up')
            </a>
            <div class="right-box">
                <a type="button" class="x-login-link" data-toggle="modal" data-target="#m-signIn">
                    <img src="{{ asset('img/login.png') }}" alt="sign in">
                    @lang('app.sign_in')
                </a>
                <a type="button" class="x-forgot-link" data-toggle="modal" data-target="#m-forgot">
                    @lang('home/home.forgot_pwd')
                </a>
            </div>

        </div>
    @endif
</section>
@include('auth.register')
@include('auth.login')
@include('auth.passwords.email')
@include('home.change_email')
@include('home.change_password')