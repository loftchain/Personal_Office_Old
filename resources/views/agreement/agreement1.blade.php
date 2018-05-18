@extends('layouts.app')

@section('content')
<div class="a-body a1-body">
    <p>@lang('agreement/agreement.a1Title_p')</p>
    <div class="a-container a1-container">
        <div class="a-container__crumbs a1-container__crumbs">
            <ul>
                <li>@lang('agreement/agreement.crumbsConditions_li')</li>
                <li>@lang('agreement/agreement.crumbsPersonal_li')</li>
                <li>@lang('agreement/agreement.crumbsPay_li')</li>
            </ul>
        </div>
        <article>
            @lang('agreement/agreement.congrats_article')
        </article>
        <a target="_blank" class="a1-container__wp" href="{{ 'files/wp_'.App::getLocale().'.pdf' }}">
            <img src="{{ asset('img/pdf.png') }}" alt="">
            <div>
                <span class="title">@lang('agreement/agreement.whiteBook_span')</span>
            </div>
        </a>
        <form id="agreement1Form" class="a1-container__btns" method="POST" action="{{ route('goToAgreement2') }}">
            {{ csrf_field() }}
            <button class="reusable-btn approve-btn" type="submit">@lang('agreement/agreement.agreedConfirm_btn')</button>
            <a class="another-option-btn" href="{{ route('logout') }}">@lang('agreement/agreement.other_a')</a>
        </form>
    </div>

</div>
<script src="{{ asset('js/noBackButton.js') }}"></script>
@endsection
@push('scripts')
    <script>
        $('.x-dashboard').hide();
    </script>
@endpush