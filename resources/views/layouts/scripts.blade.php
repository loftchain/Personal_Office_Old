<script src="{{ asset('js/app.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/jquery.min.3.2.1.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/vanilla-masker.js') }}"></script>
<script src="{{ asset('js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('js/jquery.knob.js') }}"></script>
<script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
@include('_js.js_loader_cloak')


@if(\Illuminate\Support\Facades\Route::current()->getName() == 'home'
 OR \Illuminate\Support\Facades\Route::current()->getName() == 'welcome')
    @include('_js.js_widget')
@endif


@if(isset($data) && \Illuminate\Support\Facades\Route::current()->getName() == 'home')
    @include('_js.js_wallet')
    @include('_js.js_transaction')
    @include('_js.js_admin_confirmation')
    @if(\Illuminate\Support\Facades\Auth::check())

    @endif
@endif
@include('_js.js_custom_validation')

@include('_js.js_agreement2')
