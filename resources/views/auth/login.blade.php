@extends('layouts.app')
@section('header')
    @include('customer.nav.navbar')
@endsection
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body text-center">
                <img src="{{ asset('img/login/calidad-cloud-splash.jpg') }}" alt="" class="img-fluid rounded-top">
                </div>

                <login-component
                :route-login="'{{ route('login') }}'" 
                :route-home="'{{ route('home') }}'"
                :route-reset="'{{ route('password.request') }}'"
                :route-redirect="'{{$redirect}}'"
                :token="'{{csrf_token()}}'" ></login-component>
            </div>
        </div>
    </div>
</div>
@include('auth.modal-login')
@endsection
