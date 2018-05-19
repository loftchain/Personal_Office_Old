<header>
    <section class="header">
        <div class="header__logo">
          <a class="header__logo_link" href="https://leadrex.io/">
            <img src="https://leadrex.io/img/logo.svg" alt="Logo">
          </a>
        </div>
        <div class="header__links">
            <ul>
                <li><a target="_blank" href="https://leadrex.io/#brain">@lang('layouts/header.link1_li')</a></li>
                <li><a target="_blank" href="https://leadrex.io/#doc">@lang('layouts/header.link2_li')</a></li>
                <li><a target="_blank" href="https://leadrex.io/#team">@lang('layouts/header.link3_li')</a></li>
                <li><a target="_blank" href="https://leadrex.io/#map">@lang('layouts/header.link4_li')</a></li>
            </ul>
        </div>
        <div class="header__lang">
            <a class="lang-switcher-rus {{ App::getLocale() }}" href="{{ route('lang.switch', 'ru') }}">ru</a>
            <a class="lang-switcher-eng {{ App::getLocale() }}" href="{{ route('lang.switch', 'en') }}">en</a>
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