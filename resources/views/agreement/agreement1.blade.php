@extends('layouts.app')

@section('content')
<div class="a-body a1-body">
    <p>@lang('home/agreement1.agreement_with_conditions_title')</p>
    <div class="a-container a1-container">
        <div class="a-container__crumbs a1-container__crumbs">
            <ul>
                <li>@lang('home/agreement1.agreement_with_conditions')</li>
                <li>@lang('home/agreement1.personal_information')</li>
                <li>@lang('home/agreement1.pay_in')</li>
            </ul>
        </div>
        <article>
            {{--@lang('home/agreement1.readme_big_text')--}}
            Разнообразный и богатый опыт рамки и место обучения кадров позволяет
            выполнять важные задания по разработке модели развития. Значимость этих
            проблем настолько очевидна, что дальнейшее развитие различных форм деятельности
            позволяет оценить значение систем массового участия. Идейные соображения высшего
            порядка, а также дальнейшее развитие различных форм деятельности в значительной
            степени обуславливает создание форм развития. Товарищи! укрепление и развитие
            структуры влечет за собой процесс внедрения и модернизации форм развития.
        </article>
        <a target="_blank" class="a1-container__wp" href="https://imigize.io/wp/en/">
            <img src="{{ asset('img/pdf.png') }}" alt="">
            <div>
                <span class="title">@lang('app.white_book')</span>
                <span class="name">Правила пользования.pdf</span>
            </div>
        </a>
        <form id="agreement1Form" class="a1-container__btns" method="POST" action="{{ route('goToAgreement2') }}">
            {{ csrf_field() }}
            <button class="reusable-btn approve-btn" type="submit">@lang('home/agreement1.agreed_confirm')</button>
            <a class="another-option-btn" href="{{ route('logout') }}">@lang('home/agreement1.other')</a>
        </form>
    </div>

</div>
<script src="{{ asset('js/noBackButton.js') }}"></script>
<script>
  localStorage.removeItem('email');
</script>

@endsection