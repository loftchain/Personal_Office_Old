{{--<div class="logo-language-container">--}}
{{--<a class="navbar-brand" href="{{ url('/home') }}">--}}
{{--<img src="{{ asset('img/c2p-logo.png') }}" class="logo-img">--}}
{{--</a>--}}
{{--</div>--}}
{{--<nav class="navbox navbar navbar-default">--}}
{{--<a class="free-brand navbar-brand" href="{{ url('/home') }}">--}}
{{--<img src="{{ asset('img/c2p-logo.png') }}" class="logo-img">--}}
{{--</a>--}}
{{--<div class="container">--}}

{{--<div class="collapse navbar-collapse" id="myNavbar">--}}
{{--<a class="close-collapse" href="#" data-action="mobilemenu-close"><img src="{{ asset('img/cross.png')}}"></a>--}}
{{--<div class="actions">--}}
{{--<a class="whitepaper-link"  target="_blank" href="http://c2p.mnxm.ru/#index">@lang('header/header.wp')</a>--}}
{{--<a  class="invest-link"  target="_blank" href="http://c2p.mnxm.ru/#index">@lang('header/header.inv')</a>--}}
{{--</div>--}}
{{--<div class="collapse-part">--}}
{{--<ul class="nav navbar-nav my-nav-bar">--}}
{{--<li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>--}}
{{--<li><a target="_blank" href="#">@lang('header/header.usability')</a></li>--}}
{{--<li><a target="_blank" href="#">@lang('header/header.about')</a></li>--}}
{{--<li><a target="_blank" href="#">@lang('header/header.roadmap')</a></li>--}}
{{--<li><a target="_blank" href="#">@lang('header/header.media')</a></li>--}}
{{--</ul>--}}
{{--<div class="laguage-switch">--}}
{{--<a class="lang-switcher-rus {{ App::getLocale() }}" href="{{ route('lang.switch', 'ru') }}">--}}
{{--rus--}}
{{--</a>--}}
{{--<a class="lang-switcher-eng {{ App::getLocale() }}" href="{{ route('lang.switch', 'en') }}">--}}
{{--eng--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<button type="button" class="navbar-toggle">--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--<span class="icon-bar"></span>--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}

{{--</nav>--}}
<section class="header">
    <div class="header__logo">
        <img src="" alt="">
    </div>
    <div class="header__links">
        <ul>
            <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
            <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
            <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
            <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
            <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
        </ul>
    </div>
    <div class="header__lang">
        <a class="lang-switcher-rus {{ App::getLocale() }}" href="{{ route('lang.switch', 'ru') }}">rus</a>
        <a class="lang-switcher-eng {{ App::getLocale() }}" href="{{ route('lang.switch', 'en') }}">eng</a>
    </div>
</section>