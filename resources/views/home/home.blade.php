@extends('layouts.app')

@section('content')

    @include('layouts.dashboard')
    <div class="x-body tab-content">
        @if($data['admin'] == 1)
            <div id="adminConfirmation" class="tab-pane fade">
                @include('admin.confirmation')
            </div>
            <div id="adminReferrals" class="tab-pane fade in active">
                @include('admin.referrals')
            </div>
        @else
            <div id="home" class="tab-pane fade">
                @include('home.widget')
                @include('home.wallet')
            </div>
            <div id="transactions" class="tab-pane fade">
                @include('home.transactions')
            </div>
            <div id="refs" class="tab-pane fade in active">
                @include('home.refs')
            </div>
        @endif
    </div>

@endsection
