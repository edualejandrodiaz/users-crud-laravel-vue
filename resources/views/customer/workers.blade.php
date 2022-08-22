@extends('layouts.app')
@section('css')
<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
<style>
    .nav-fill .nav-item {
        border: 1px solid #eee;
        width: 160px;
    }

    .nav-tabs {
        border-bottom: #f1f1f1 1px solid;
        background-color: #FFFFFF;
        border-radius: 5px;
        font-weight: normal;
    }
</style>
@endsection
@section('header')

    @include('customer.nav.navbar-auth')

@endsection
@section('content')
  <section>
    <workers-component 
    :route-products="'{{ route('api.products') }}'" 
    :route-workers="'{{ route('api.workers') }}'" 
    :secret="'{{ $secret }}'"
    :route-more-results="'{{ route('api.workers.more.results') }}'" 
    :find="'{{$search}}'"
    :customer='@json($customer)' 
    :token="'{{csrf_token()}}'"></workers-component>
  </section>

@include('auth.modal-login')
  @endsection