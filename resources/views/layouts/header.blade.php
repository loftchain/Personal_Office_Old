<header>
    <section class="header">
        <div class="header__logo">
          <a class="header__logo_link" href="https://opnplatform.io/">
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
            <button class="dropdown__btn">{!! trans('layouts/header.lang_button') !!}</button>
            <div class="dropdown__content">
              <a href="{{ route('lang.switch', 'en') }}">english</a>
              <a href="{{ route('lang.switch', 'ru') }}">русский</a>
              <a href="{{ route('lang.switch', 'es') }}">español</a>
              <a href="{{ route('lang.switch', 'tr') }}">türk</a>
              <a href="{{ route('lang.switch', 'kr') }}">한국</a>
              <a href="{{ route('lang.switch', 'cn') }}">中文</a>
            </div>
          </div>
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