@extends('layouts.app')

@section('content')
<div class="a-body a2-body">
    <p>@lang('agreement/agreement.a2Title_p')</p>
    <div class="a-container a2-container">
        <div class="a-container__crumbs a2-container__crumbs">
            <ul>
              <li>@lang('agreement/agreement.crumbsConditions_li')</li>
              <li>@lang('agreement/agreement.crumbsPersonal_li')</li>
              <li>@lang('agreement/agreement.crumbsPay_li')</li>
            </ul>
        </div>
        <article class="a2-container__article">
          @lang('agreement/agreement.info_article')
        </article>
        <section class="a2-container__section doc-section">
            <form id="upload" method="post" action="{{ route('store_documents') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div id="drop">
                    <span>@lang('agreement/agreement.loadDocs_span')</span>
                    <a>@lang('agreement/agreement.loadDocs_btn')</a>
                    <input type="file" name="upl" multiple />
                    <ul class="doc-container"></ul>
                </div>

            </form>
        </section>
        <section class="a2-container__section text-section">
            <form class="a2-form" method="POST" accept-charset="multipart/form-data" enctype="multipart/form-data" action="{{ route('store_personal_data') }}">
                <div class="input-text-container input-container-left">
                    {{ csrf_field() }}
                    <label for="name_surname" class=""> @lang('agreement/agreement.nameSurname_label')</label>
                    <input id="name_surname" type="text" class="x-input" name="name_surname">
                    <div class="error-message error-message0 name_surname"></div>

                    <label for="telegram" class=""> @lang('agreement/agreement.telegram_label')</label>
                    <input id="telegram" type="text" class="x-input" name="telegram">
                    <div class="error-message error-message1 telegram"></div>

                    <label for="emergency_email" class=""> @lang('agreement/agreement.extraEmail_label')</label>
                    <input id="emergency_email" type="text" class="x-input" name="emergency_email">
                    <div class="error-message error-message2 emergency_email"></div>

                    <label for="permanent_address" class=""> @lang('agreement/agreement.permAddress_label')</label>
                    <input id="permanent_address" type="text" class="x-input" name="permanent_address">
                    <div class="error-message error-message3 permanent_address"></div>
                </div>
                <div class="input-text-container input-container-left">
                    <label for="contact_number" class=""> @lang('agreement/agreement.phone_label')</label>
                    <input id="contact_number" type="text" class="x-input" name="contact_number">
                    <div class="error-message error-message4 contact_number"></div>

                    <label for="date_place_birth" class=""> @lang('agreement/agreement.datePlaceBirth_label')</label>
                    <input id="date_place_birth" type="text" class="x-input" name="date_place_birth">
                    <div class="error-message error-message5 date_place_birth"></div>

                    <label for="nationality" class=""> @lang('agreement/agreement.nationality_label')</label>
                    <input id="nationality" type="text" class="x-input" name="nationality">
                    <div class="error-message error-message6 nationality"></div>

                    <label for="source_of_funds" class=""> @lang('agreement/agreement.sourceOfFunds_label')</label>
                    <input id="source_of_funds" type="text" class="x-input" name="source_of_funds">
                    <div class="error-message error-message7 source_of_funds"></div>
                </div>
                <div class="check-box-container">
                    <div>
                        <label for="terms" class="">@lang('agreement/agreement.agreeWithTerms_label')</label>
                        <input type="checkbox" id="terms" class="terms-checkbox" name="terms">
                    </div>
                    <button type="submit" class="a2-form__sbmt-btn">@lang('agreement/agreement.save_btn')</button>
                </div>
            </form>
        </section>
    </div>
</div>
    <script src="{{ asset('js/noBackButton.js') }}"></script>
@endsection
