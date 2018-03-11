@if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif
@include('_js.js_misc')

<script src="{{ asset('js/script.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/app.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/jquery.min.3.2.1.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mycrypto.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/date_count_down.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/widget.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/vanilla-masker.js?v='.env('VERSION')) }}"></script>
@include('_js.js_custom_validation')
@include('_js.js_temp')
