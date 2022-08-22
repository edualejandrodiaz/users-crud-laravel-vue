<nav class="navbar navbar-light navbar-expand-lg shadow-sm fixed-top sticky-top bg-white  header-nav">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ route('landing') }}">
        <img src="{{ asset('img/logo-calidad-cloud.webp') }}" height="60" class="logo-header" alt="">
    </a>


    <form class="form-inline d-block d-md-none">


       
        
        
    </form>
    

    





    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
        


        
        @auth

        <li class="nav-item">
            <a class="nav-link" href="{{ route('workers') }}">Trabajadores</a>
        </li>
        @endauth
    
        <li class="nav-item">
            <a class="nav-link">
                @auth
                    
                    <form action="{{ route('logout') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit" class="btn-login-logout btn-sm btn-rounded btn-secondary px-0 text-capitalize waves-effect waves-light" style="font-size: 15px;max-width: 160px;min-width: 159px;"><i class="fa fa-sign-out-alt"></i> Cerrar sesión</button>
                    </form>
                    

                @else
                    <ini-session-component></ini-session-component>

                @endauth
            </a>
        </li>

        </ul>


        <!-- Links -->

    </div>
    <!-- Collapsible content -->


    </div>
</nav>