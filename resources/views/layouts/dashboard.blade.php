<section class="x-dashboard {{ Auth::check() ? 'auth' : 'guest' }}">
    @if (Auth::check())
        <div class="x-dashboard__info">
            <span class="x-dashboard__info_who"> @lang('home/home.logged_in_as'): {{ obfuscate_email(Auth::user()->email) }}</span>
            <span class="x-dashboard__info_tokens">0 {{ env('TOKEN_NAME') }}</span>
        </div>
        <div class="x-dashboard__tabs">
            <ul class="nav nav-tabs">
                @if($data['admin'] == 1)
                    <li class="active"> <a data-toggle="tab" href="#adminConfirmation">Confirmation</a> </li>
                    <li> <a data-toggle="tab" href="#adminReferrals">Referrals</a> </li>
                @else
                    <li class="active"> <a data-toggle="tab" href="#home">@lang('home/home.token_sale')</a> </li>
                    <li> <a data-toggle="tab" href="#transactions">@lang('home/home.my_transactions')</a> </li>
                    <li> <a data-toggle="tab" href="#refs">мои рефералы</a> </li>
                @endif
            </ul>
        </div>
        <div class="x-dashboard__options">
            <a href="{{ route('logout') }}" class="x-dashboard__options_out"><img src="{{ asset('img/logout.png') }}" alt="logout">@lang('home/home.log_out')</a>
            <a type="button" class="x-dashboard__options_email" data-toggle="modal" data-target="#m-ch-email">@lang('home/home.change_email')</a>
            <a type="button" class="x-dashboard__options_password" data-toggle="modal" data-target="#m-ch-pwd">@lang('home/home.change_password')</a>
        </div>
    @endif
</section>
@include('modals.change_email')
@include('modals.change_password')