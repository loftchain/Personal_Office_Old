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
<script src="{{ asset('js/mini-uploader.script.js') }}"></script>
@include('_js.js_loader_cloak')

@if(isset($data) && \Illuminate\Support\Facades\Route::current()->getName() == 'home')
    @include('_js.js_widget')
    @if(\Illuminate\Support\Facades\Auth::check())
        @include('_js.js_wallet')
        @include('_js.js_transaction')
    @endif
@endif
@include('_js.js_custom_validation')

@if(\Illuminate\Support\Facades\Route::current()->getName() !== 'agreement2')
@endif

@include('_js.js_agreement2')
