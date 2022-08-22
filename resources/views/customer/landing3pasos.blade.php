@extends('layouts.app')
@section('header')
    @include('customer.nav.navbar')
@endsection
@section('content')

<section>
    <landing-component :route-pedido-especial="'{{ route('product.pedido.especial', 0) }}'" ></landing-component>
    
</section>



@include('auth.modal-login')
@endsection

