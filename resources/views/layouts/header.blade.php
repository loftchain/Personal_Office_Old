<header>
    <section class="header">
        <div class="header__logo">
            <img src="{{ asset('img/temp-logo.png') }}" alt="Logo">
        </div>
        <div class="header__links">
            <ul>
                <li><a target="_blank" href="#">@lang('header/header.wp')</a></li>
                <li><a target="_blank" href="#">@lang('header/header.about')</a></li>
                <li><a target="_blank" href="#">@lang('header/header.roadmap')</a></li>
                <li><a target="_blank" href="#">@lang('header/header.advantage')</a></li>
                <li><a target="_blank" href="#">@lang('header/header.faq')</a></li>
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