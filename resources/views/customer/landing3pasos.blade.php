@extends('layouts.app')
@section('header')
    @include('customer.nav.navbar')
@endsection
@section('content')

<section>
    <landing-component></landing-component>
    
</section>



@include('auth.modal-login')
@endsection

