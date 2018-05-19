<section class="x-dashboard {{ Auth::check() ? 'auth' : 'guest' }}">
    @if (Auth::check())
        <div class="x-dashboard__info">
            <span class="x-dashboard__info_who"> @lang('layouts/dashboard.loggedInAs'): {{ obfuscate_email(Auth::user()->email) }}</span>
            <span class="x-dashboard__info_tokens">0 {{ env('TOKEN_NAME') }}</span>
        </div>
        <div class="x-dashboard__tabs">
            <ul class="nav nav-tabs">
                @if($data['admin'] == 1)
                    <li class="active"> <a data-toggle="tab" href="#adminConfirmation">@lang('layouts/dashboard.сonfirmation')</a></li>
                    <li> <a data-toggle="tab" href="#adminReferrals">@lang('layouts/dashboard.referrals')</a> </li>
                @else
                    <li class="active"> <a data-toggle="tab" href="#home">@lang('layouts/dashboard.ico')</a> </li>
                    <li> <a data-toggle="tab" href="#transactions">@lang('layouts/dashboard.myTx')</a> </li>
                    <li> <a data-toggle="tab" href="#refs">@lang('layouts/dashboard.myRefs')</a> </li>
                @endif
            </ul>
        </div>
        <div class="x-dashboard__options">
            <a href="{{ route('logout') }}" class="x-dashboard__options_out"><img src="{{ asset('img/logout.png') }}" alt="logout">@lang('layouts/dashboard.logOut')</a>
            <a type="button" class="x-dashboard__options_email" data-toggle="modal" data-target="#m-ch-email">@lang('layouts/dashboard.changeEmail')</a>
            <a type="button" class="x-dashboard__options_password" data-toggle="modal" data-target="#m-ch-pwd">@lang('layouts/dashboard.changePassword')</a>
        </div>
    @endif
</section>
@include('modals.change_email')
@include('modals.change_password')