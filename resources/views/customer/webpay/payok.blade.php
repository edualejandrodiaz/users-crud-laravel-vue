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
  <div class="container pb-5 pt-4">
    <div class="row bg-white justify-content-center">
      <div class="col-md-12 text-center my-2">
        <img src="/img/pago/checked.png" class="mb-4" style="height:100px;" alt="">
        <h6 class="christiana-medium">¡Tu pedido fue realizado exitosamente!</h6>
        <h2 class="christiana-medium pt-3">Pedido {{ $order->id }}</h2>
      </div>
    </div>

    <!--  -->
    <!-- <div class="container bg-white"> -->
      <div class="row bg-white justify-content-center">
      <div class="col-md-10">

        <div class="table-responsive" style="margin: 30px 0px 80px 0px;">
          <table style="width:90%; margin: 0 auto; border-collapse: collapse; text-align: center; font-size: .85rem;">
            <tbody><tr>
              <th colspan="5" style="font-weight: 300; padding: 10px; text-align: center;">INFORMACIÓN EXTRA DE LA TRANSACCIÓN</th>
            </tr>

            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>FECHA INGRESO:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ date('d/m/Y') }}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>ESTADO:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">PROGRAMADO</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>NOMBRE ENTREGA:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $address->firstname}} {{ $address->lastname }}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>DIRECCIÓN ENTREGA:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $address->address}}, {{ $address->comuna}}, {{$address->region}}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>CORREO:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $user->email }}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>TELEFONO:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $user->telephone }}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>CORREO QUIEN RECIVE:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $address->email }}</td>
            </tr>
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 10px; text-align: start; font-weight: 200; "><strong>TELEFONO QUIEN RECIVE:</strong></td>
              <td colspan="2" style="font-weight: 300; text-align: start; padding: 10px;">{{ $address->telephone }}</td>
            </tr>



          </tbody></table>
        </div>

        <div class="table-responsive">
          <table style="width:90%; margin: 0 auto; border-collapse: collapse; text-align: center; font-size: .85rem;">
            <tbody><tr>
              <th colspan="2" style="font-weight: 300; padding: 10px;">PRODUCTO</th>
              <th style="font-weight: 300; padding: 10px;">CANTIDAD</th>
              <th style="font-weight: 300; padding: 10px;">PRECIO</th>
            </tr>

            @foreach($carroFinal as $key => $product)
           
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="2" style="padding: 15px;">
                <div style="display: flex;">
                  <h6 style="text-align: start; font-weight: 300; "><strong>{{$product->name}}</strong> <br>
                  </h6>
                </div>
              </td>
              <td style="font-weight: 300;">{{$product->pivot->quantity}}</td>
              <td style="font-weight: 300; "><strong>$ {{ number_format($product->price * $product->pivot->quantity, 0, ',', '.') }} CLP</strong></td>
            </tr>
            @endforeach


            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="3" style="padding: 10px; text-align: start; font-weight: 200; ">SUBTOTAL</td>
              <td colspan="2" style="font-weight: 300; text-align: end; padding: 10px; ">${{number_format($subtotal, 0, ',', '.')}}</td>
            </tr>
            @if($envio > 0)
            <tr style="border-top: 1px solid #1A1A1A;">
              <td colspan="3" style="padding: 10px; text-align: start; font-weight: 200; ">ENVIO</td>
              <td colspan="2" style="font-weight: 300; text-align: center; padding: 10px; ">${{number_format($envio, 0, ',', '.')}}</td>
            </tr>
            @endif
            

            <tr style="border-top: 1px solid #1A1A1A; border-bottom: 1px solid #1A1A1A;">
              <td colspan="3" style="padding: 10px; text-align: start; font-weight: 200; ">TOTAL</td>
              <td colspan="2" style="font-weight: 300; text-align: center; padding: 10px; ">${{number_format($total, 0, ',', '.')}}</td>
            </tr>

          </tbody></table>
        </div>




        <div class="row justify-content-center align-items-center pb-5 pt-5">
        <a href="{{ route('home') }}" class="btn btn-primary btn-rounded btn-block px-0 text-capitalize waves-effect waves-light mt-3">VOLVER A LA TIENDA</a>
        </div>
      </div>
    </div>
      <!--  -->


    <!-- </div> -->
  </div>
  </section>

@include('auth.modal-login')
  @endsection