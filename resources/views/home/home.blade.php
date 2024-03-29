@extends('layouts.app')

@section('content')

    @include('layouts.dashboard')
    <div id="xBody" class="x-body tab-content">
        @if($data['admin'] == 1)
            <div id="adminConfirmation" class="tab-pane fade in active">
              @include('admin.confirmation')
            </div>
            <div id="adminTxInfo" class="tab-pane fade">
              @include('admin.txInfo')
            </div>
            <div id="adminReferrals" class="tab-pane fade">
                @include('admin.referrals')
            </div>
        @else
            <div id="home" class="tab-pane fade in active">
                @include('home.widget')
                @include('home.wallet')
            </div>
            <div id="transactions" class="tab-pane fade">
                @include('home.transactions')
            </div>
            <div id="refs" class="tab-pane fade">
                @include('home.refs')
            </div>
            <div id="changelly" class="tab-pane fade">
              @include('home.changelly')
            </div>
        @endif
    </div>

@endsection
