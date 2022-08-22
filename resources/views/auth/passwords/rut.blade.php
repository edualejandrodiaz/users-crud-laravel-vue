@extends('layouts.app')
@section('header')
    @include('customer.nav.navbar')
@endsection
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body text-center">
                <img src="{{ asset('img/login/calidad-cloud-splash.jpg') }}" alt="" class="img-fluid rounded-top">
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="rut" class="col-md-4 col-form-label text-md-right">RUT</label>

                            <div class="col-md-6">
                                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" oninput="formatRut(this)" name="rut" value="{{ old('rut') }}" required autocomplete="rut" autofocus>

                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('auth.modal-login')

@endsection
@section('scripts')
<script src="{{ asset('js/rut.min.js') }}" type="text/javascript" ></script>
<script>
    rutObj = new Rut('');

    function formatRut(input){
        var rut = input.value;
        console.log('rut',rut);
        rut = rut.replace(/[\[\].]+/g,"");
        rut = rut.replace('-','');
        rutObj.setRut(rut);
        if( rut.length > 2 ){
            var value = rutObj.getNiceRut();
            console.log(value);
            input.value = value;
        } 
        
    }

</script>
@endsection