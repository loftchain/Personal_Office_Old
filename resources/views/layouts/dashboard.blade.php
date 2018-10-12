<?php $myTokens = app('App\Services\WalletService')->getMyTokens() ?>

<section class="x-dashboard {{ Auth::check() ? 'auth' : 'guest' }}">
    @if (Auth::check())
        <div class="x-dashboard__info">
            <span class="x-dashboard__info_who"> {!! trans('layouts/dashboard.loggedInAs') !!}: {{ obfuscate_email(Auth::user()->email) }}</span>
            <span class="x-dashboard__info_tokens">{{ $myTokens }} {{ env('TOKEN_NAME') }}</span>
        </div>
        <div class="x-dashboard__tabs">
            <ul class="nav nav-tabs">
                @if($data['admin'] == 1)
                <li class="active"> <a data-toggle="tab" href="#adminTxInfo">tx info</a> </li>
                <li> <a data-toggle="tab" href="#adminReferrals">{!! trans('layouts/dashboard.referrals') !!}</a> </li>
                <li> <a data-toggle="tab" href="#adminKyc">RU KYC</a> </li>
                @else
                    <li class="active"> <a data-toggle="tab" href="#home">{!! trans('layouts/dashboard.ico') !!}</a> </li>
                    <li> <a data-toggle="tab" href="#transactions">{!! trans('layouts/dashboard.myTx') !!}</a> </li>
                    <li> <a data-toggle="tab" href="#refs">{!! trans('layouts/dashboard.myRefs') !!}</a> </li>
                    <li> <a data-toggle="tab" href="#changelly">{!! trans('layouts/dashboard.changelly') !!}</a> </li>
                    <li> <a data-toggle="tab" href="#howToUse">{!! trans('layouts/dashboard.howToUse') !!}</a> </li>
                @endif
            </ul>
        </div>
        <div class="x-dashboard__options">
            <a href="{{ route('logout') }}" class="x-dashboard__options_out"><img src="{{ asset('img/logout.png') }}" alt="logout">{!! trans('layouts/dashboard.logOut') !!}</a>
            <a type="button" class="x-dashboard__options_email" data-toggle="modal" data-target="#m-ch-email">{!! trans('layouts/dashboard.changeEmail') !!}</a>
            <a type="button" class="x-dashboard__options_password" data-toggle="modal" data-target="#m-ch-pwd">{!! trans('layouts/dashboard.changePassword') !!}</a>
        </div>
    @endif
</section>
@include('modals.change_email')
@include('modals.change_password')
@include('modals.ETH_customers_wallet')
@include('modals.BTC_customers_wallet')