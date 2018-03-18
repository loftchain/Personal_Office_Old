{{--@if(config('app.env') == 'local')--}}
    {{--<script src="http://localhost:35729/livereload.js"></script>--}}
{{--@endif--}}

<script src="{{ asset('js/app.js?v='.env('VERSION')) }}"></script>
<script src="{{ asset('js/jquery.min.3.2.1.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/vanilla-masker.js') }}"></script>
@include('_js.js_custom_validation')
@include('_js.js_accordion')
