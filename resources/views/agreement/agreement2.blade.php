@extends('layouts.app')

@section('content')
<div class="a-body a2-body">
    <p>@lang('home/agreement2.personal_information_title')</p>
    <div class="a-container a2-container">
        <div class="a-container__crumbs a2-container__crumbs">
            <ul>
              <li>@lang('home/agreement1.agreement_with_conditions')</li>
              <li>@lang('home/agreement1.personal_information')</li>
              <li>@lang('home/agreement1.pay_in')</li>
            </ul>
        </div>
        <article class="a2-container__article">
          @lang('home/agreement2.attention_big_text')
        </article>
        <section class="a2-container__section doc-section">
            <form id="upload" method="post" action="{{ route('store_documents') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div id="drop">
                    <span>Перетащите изображение документа сюда<br> (принимаемые форматы: jpg, jpeg, png, svg, pdf, zip, rar)</span>
                    <a>Загрузить</a>
                    <input type="file" name="upl" multiple />
                    <ul class="doc-container"></ul>
                </div>

            </form>
        </section>
        <section class="a2-container__section text-section">
            <form class="a2-form" method="POST" accept-charset="multipart/form-data" enctype="multipart/form-data" action="{{ route('store_personal_data') }}">
                <div class="input-text-container input-container-left">
                    {{ csrf_field() }}
                    <label for="name_surname" class=""> @lang('home/agreement2.name_surname')</label>
                    <input id="name_surname" type="text" class="x-input" name="name_surname">
                    <div class="error-message error-message0 name_surname"></div>

                    <label for="telegram" class=""> @lang('home/agreement2.telegram')</label>
                    <input id="telegram" type="text" class="x-input" name="telegram">
                    <div class="error-message error-message1 telegram"></div>

                    <label for="emergency_email" class=""> @lang('home/agreement2.extra_email')</label>
                    <input id="emergency_email" type="text" class="x-input" name="emergency_email">
                    <div class="error-message error-message2 emergency_email"></div>

                    <label for="permanent_address" class=""> @lang('home/agreement2.perm_address')</label>
                    <input id="permanent_address" type="text" class="x-input" name="permanent_address">
                    <div class="error-message error-message3 permanent_address"></div>
                </div>
                <div class="input-text-container input-container-left">
                    <label for="contact_number" class=""> @lang('home/agreement2.contact_number')</label>
                    <input id="contact_number" type="text" class="x-input" name="contact_number">
                    <div class="error-message error-message4 contact_number"></div>

                    <label for="date_place_birth" class=""> @lang('home/agreement2.date_place_birth')</label>
                    <input id="date_place_birth" type="text" class="x-input" name="date_place_birth">
                    <div class="error-message error-message5 date_place_birth"></div>

                    <label for="nationality" class=""> @lang('home/agreement2.nationality')</label>
                    <input id="nationality" type="text" class="x-input" name="nationality">
                    <div class="error-message error-message6 nationality"></div>

                    <label for="source_of_funds" class=""> @lang('home/agreement2.source_of_funds')</label>
                    <input id="source_of_funds" type="text" class="x-input" name="source_of_funds">
                    <div class="error-message error-message7 source_of_funds"></div>
                </div>
                <div class="check-box-container">
                    <div>
                        <label for="terms" class=""> Даю согласие на обработку моих персональных данных</label>
                        <input type="checkbox" id="terms" class="terms-checkbox" name="terms">
                    </div>
                    <button type="submit" class="a2-form__sbmt-btn">@lang('home/mycrypto.save_btn')</button>
                </div>
            </form>
        </section>
    </div>
</div>
    <script src="{{ asset('js/noBackButton.js') }}"></script>
@endsection
