@extends('admin.layouts.admin-inchalam')
@section('customMdbStyle')
{{-- Material Design Bootstrap --}}
<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
@endsection
@section('head')
@include('admin.includes.head')
<style>
    .password-icon {
          float: right;
          position: relative;
          margin: -25px 10px 0 0;
          cursor: pointer;
      }
    @media (min-width: 768px){

        body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
            margin-left: 0px;
        }
    }

</style>

@endsection
@section('navbar')
@include('admin.includes.navbar')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center middle-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header" style="background: #cbd2d8">
                    <a class="brand-link" style="padding:0;">
                    <img src="{{ asset('img/logo-farmacia-etica-white.webp') }}" class="brand-image" style="opacity: 1;max-height: 64px;" alt="logo"/>

                    <span class="brand-text font-weight-light">&nbsp;</span>
                    </a>
            </div>
            @if (session('success'))
                    <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                    </div>
            @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                    <form method="POST" action="{{ route('admin.auth') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

                            <div class="col-md-6">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                <span class="fa fa-fw fa-eye password-icon show-password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-4">

                              <!--  <input class="custom-control-input form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label form-check-label" for="Recuerdame">
                                    {{ __('Remember Me') }}
                                </label>-->
                            </div>
                            <div class="col-md-4">

                                @if (Route::has('password.request'))
                                    <a href="{{ route('admin.password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>

                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary2">
                                    {{ __('Ingresar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@endsection
<script>
    window.addEventListener("load", function() {

               // icono para mostrar contraseña

               showPassword = document.querySelector('.show-password');
               showPassword.addEventListener('click', () => {

                   // elementos input de tipo clave
                   password1 = document.querySelector('#password');


                   if ( password1.type === "text" ) {
                       password1.type = "password"

                       showPassword.classList.remove('fa-eye-slash');
                   } else {
                       password1.type = "text"

                       showPassword.classList.toggle("fa-eye-slash");
                   }

               });

           });
   </script>
