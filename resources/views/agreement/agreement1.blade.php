@extends('layouts.app')

@section('content')
<div class="a-body a1-body">
    <p>{!! trans('agreement/agreement.a1Title_p') !!}</p>
    <div class="a-container a1-container">
      <div class="a1-container-wrapper">
        <article>
          {!! trans('agreement/agreement.congrats_article') !!}
        </article>
        <a target="_blank" class="a1-container-wrapper__wp" href="https://drive.google.com/file/d/12MKdsHPQLQEqS5Ep9sO3BI30FJ1fGso-/view">
          <img src="{{ asset('img/pdf.png') }}" alt="">
          <span class="title">{!! trans('agreement/agreement.whiteBook_span') !!}</span>
        </a>
      </div>
      <form id="agreement1Form" class="a1-container__btns" method="POST" action="{{ route('goToAgreement2') }}">
          {{ csrf_field() }}
          <button class="reusable-btn approve-btn" type="submit">{!! trans('agreement/agreement.agreedConfirm_btn') !!}</button>
          <a class="another-option-btn" href="{{ route('logout') }}">{!! trans('agreement/agreement.other_a') !!}</a>
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