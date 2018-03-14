@extends('layouts.app')

@section('content')

    <div class="x-body tab-content">
        <div id="home" class="tab-pane fade in active">
            @include('home.new_widget')
            @include('home.new_wallet')
        </div>
        <div id="transactions" class="tab-pane fade">
            @include('home.my_transactions.transactions')
        </div>
    </div>
@endsection
