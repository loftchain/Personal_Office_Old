<header>
    <section class="header">
        <div class="header__logo">
            <img src="https://leadrex.io/img/logo.svg" alt="Logo">
        </div>
        <div class="header__links">
            <ul>
                <li><a target="_blank" href="https://leadrex.io/#brain">Что такое Leadrex</a></li>
                <li><a target="_blank" href="https://leadrex.io/#doc">Документация</a></li>
                <li><a target="_blank" href="https://leadrex.io/#team">Команда</a></li>
                <li><a target="_blank" href="https://leadrex.io/#map">Дорожная карта</a></li>
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