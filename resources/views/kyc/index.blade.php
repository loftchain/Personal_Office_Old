@extends('layouts.app')

@section('content')
    <div class="kyc-container">
            <h1>{!! trans('kyc/index.congratz') !!}</h1>
            <button id="signupButton" class="btn btn-primary" type="button">
                <span>{!! trans('kyc/index.passKYC') !!}</span>
            </button>
    </div>
@endsection