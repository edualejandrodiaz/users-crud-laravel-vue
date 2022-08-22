<nav class="navbar navbar-dark navbar-expand-lg shadow-sm sticky-top  bg-primary" style="background-color: rgb(223, 223, 223);">
    <div class="container">
      

      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      
      <a href="{{ route('landing') }}" class="navbar-brand p-0">
          <h3 class="m-0 text-white">Calidad Cloud</h3>
      </a>
                
               

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="basicExampleNav">

        

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link grey-text waves-effect waves-light" href="#" data-toggle="modal" data-target="#modallogin"><i class="fas fa-user pr-2"></i>Ingresar a mi cuenta</a>
          </li>

          
        </ul>



        <!-- vista movile -->
        <div class="col-12 d-block d-sm-block d-md-none pt-movil-3">
          <div class="row">
            <div class="col-3">
              <span class="text-8 color-primary">Cliente</span>
            </div>
            <div class="col-9">
              <hr>
            </div>
          </div>
        </div>
       
        <!-- /vista movile -->
        <!-- Links -->

      </div>
      <!-- Collapsible content -->
    </div>
  </nav>