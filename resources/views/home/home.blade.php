@extends('layouts.app')

@section('content')

    @include('layouts.dashboard')
    <div class="x-body tab-content">
        @if($data['admin'] == 1)
            <div id="admin" class="tab-pane fade in active">
                @include('admin.confirmation')
            </div>
        @else
            <div id="home" class="tab-pane fade in active">
                @include('home.widget')
                @include('home.wallet')
            </div>
            <div id="transactions" class="tab-pane fade">
                @include('home.transactions')
            </div>
        @endif
    </div>

@endsection
