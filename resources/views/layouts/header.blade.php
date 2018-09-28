<header>
    <script src="{{ asset('js/jquery.min.3.2.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <section class="header">
        <div class="header__logo">
          <a class="header__logo_link" href="https://leadrex.io/">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo">
          </a>
        </div>
        <div class="header__links">
            <ul>
                <li><a target="_blank" href="https://opnplatform.io/#howworks">{!! trans('layouts/header.link1_li') !!}</a></li>
                <li><a target="_blank" href="https://opnplatform.io/#whitepapper">{!! trans('layouts/header.link2_li') !!}</a></li>
                <li><a target="_blank" href="https://opnplatform.io/#roadmap">{!! trans('layouts/header.link3_li') !!}</a></li>
                <li><a target="_blank" href="https://opnplatform.io/#team">{!! trans('layouts/header.link4_li') !!}</a></li>
            </ul>
        </div>
        <div class="header__lang">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Lang
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="{{ route('lang.switch', 'en') }}">en</a></li>
                    <li><a href="{{ route('lang.switch', 'ru') }}">ru</a></li>
                </ul>
            </div>
          {{--<a class="lang-switcher-eng {{ App::getLocale() }}" href="{{ route('lang.switch', 'en') }}">en</a>--}}
          {{--<a class="lang-switcher-rus {{ App::getLocale() }}" href="{{ route('lang.switch', 'ru') }}">ru</a>--}}
        </div>
        <div class="header__burger">
            <button class="hamburger hamburger--spin" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
        </div>
    </section>
</header>
<script>
  var hamburger = document.querySelector(".hamburger");
  var links = document.querySelector(".header__links");
  hamburger.addEventListener("click", function() {
    hamburger.classList.toggle("is-active");
    links.classList.toggle("is-active");
  });
</script>