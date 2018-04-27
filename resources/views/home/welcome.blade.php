@extends('layouts.app')

@section('content')

    @include('layouts.dashboard')
    <div class="x-body tab-content">
            <div id="home" class="tab-pane fade in active">
                @include('home.widget')
                @include('home.wallet')
            </div>
            <div id="transactions" class="tab-pane fade">
                @include('home.transactions')
            </div>
    </div>

@endsection
