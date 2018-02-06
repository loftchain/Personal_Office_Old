<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Imigize') }}</title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fa/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobirise/mobirise.style.css') }}">
    <link href="{{ asset('css/app.css?v='.env('VERSION')) }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,300,400|Roboto:100,300,400,500&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
    <link href="{{ asset('css/styles.css?v='.env('VERSION')) }}" rel="stylesheet">
    <link href="{{ asset('css/widget.css?v='.env('VERSION')) }}" rel="stylesheet">
    <link href="{{ asset('css/tables.css?v='.env('VERSION')) }}" rel="stylesheet">
    <link href="{{ asset('css/styles.desktop.css?v='.env('VERSION')) }}" rel="stylesheet">
    <link href="{{ asset('css/styles.mobile.css?v='.env('VERSION')) }}" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div id="app">

  <header>
    <div class="logo-language-container">
      <a class="navbar-brand" href="{{ url('/home') }}">
        <img src="{{ asset('img/c2p-logo.png') }}" class="logo-img">
      </a>
        </div>
        <nav class="navbox navbar navbar-default">

            <a class="free-brand navbar-brand" href="{{ url('/home') }}">
                <img src="{{ asset('img/c2p-logo.png') }}" class="logo-img">
            </a>
            <div class="container">

                <div class="collapse navbar-collapse" id="myNavbar">
                    {{--<a class="close-collapse" href="#" data-action="mobilemenu-close"><img src="{{ asset('img/cross.png')}}"></a>--}}
                    <div class="actions">
                        <a class="whitepaper-link"  target="_blank" href="http://c2p.mnxm.ru/#index">@lang('header/header.wp')</a>
                        <a  class="invest-link"  target="_blank" href="http://c2p.mnxm.ru/#index">@lang('header/header.inv')</a>
                    </div>
                    <div class="collapse-part">
                        <ul class="nav navbar-nav my-nav-bar">
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#index">@lang('header/header.advantage')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#advantages">@lang('header/header.usability')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#usage">@lang('header/header.about')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#roadmap">@lang('header/header.roadmap')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#media">@lang('header/header.media')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#team">@lang('header/header.team')</a></li>
                            <li><a target="_blank" href="http://c2p.mnxm.ru/#faq">@lang('header/header.faq')</a></li>
                        </ul>
                        <div class="laguage-switch">
                            <a class="lang-switcher-rus {{ App::getLocale() }}" href="{{ route('lang.switch', 'ru') }}">
                                rus
                            </a>
                            <a class="lang-switcher-eng {{ App::getLocale() }}" href="{{ route('lang.switch', 'en') }}">
                                eng
                            </a>
                        </div>
                    </div>
                    <button type="button" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>

        </nav>
    </header>

    @yield('content')

</div>

<script>
    var Jan = '{{ __('app.january_short') }}',
        Feb = '{{ __('app.february_short') }}',
        Mar = '{{ __('app.march_short') }}',
        Apr = '{{ __('app.april_short') }}',
        May = '{{ __('app.may_short') }}',
        June = '{{ __('app.june_short') }}',
        July = '{{ __('app.july_short') }}',
        Aug = '{{ __('app.august_short') }}',
        Sept = '{{ __('app.september_short') }}',
        Oct = '{{ __('app.october_short') }}',
        Nov = '{{ __('app.november_short') }}',
        Dec = '{{ __('app.december_short') }}';

    var January = '{{ __('app.january') }}',
        February = '{{ __('app.february') }}',
        March = '{{ __('app.march') }}',
        April = '{{ __('app.april') }}',
        May = '{{ __('app.may') }}',
        June = '{{ __('app.june') }}',
        July = '{{ __('app.july') }}',
        August = '{{ __('app.august') }}',
        September = '{{ __('app.september') }}',
        October = '{{ __('app.october') }}',
        November = '{{ __('app.november') }}',
        December = '{{ __('app.december') }}';

    var day_0 = '{{ __('app.day_0') }}',
        day_1 = '{{ __('app.day_1') }}',
        day_234 = '{{ __('app.day_234') }}',
        day_default = '{{ __('app.day_default') }}';

    var mycrypto_text1 = '{!! __('home/mycrypto.enter_ethereum_for_both') !!}';
    var mycrypto_text2_0 = '{!! __('home/mycrypto.enter_invest_wallet1') !!}';
    var mycrypto_text2_1 = '{!! __('home/mycrypto.enter_invest_wallet2') !!}';
    var mycrypto_text2_2 = '{!! __('home/mycrypto.exch_not_allowed') !!}';
</script>

<!-- Scripts -->
<!-- Scripts -->

<script src="{{ asset('js/jquery.min.3.2.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/script.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/app.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/mycrypto.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/date_count_down.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/widget.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/vanilla-masker.js?v='.env('VERSION')) }}"></script>
@include('_js.js_custom_validation')

@yield('script')


</body>
</html>
