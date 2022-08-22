  <!-- Modal --> 
  <div class="modal fade py-0 my-0" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog py-0 my-0" role="document">
    <div class="modal-content shadow-none" style="background: transparent; box-shadow: transparent; border:none;">
    
    <div class="modal-body pb-0 mb-0" style="background: transparent;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 0; top:0; opacity: 1; background-color: #fff; border-radius: 50%; padding: 10px 12px 6px 12px; z-index: 2;">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="card shadow rounded-card">
        <img src="{{ asset('img/login/calidad-cloud-splash.jpg') }}" class="img-fluid rounded-top" alt="">
        <div class="card-body px-5">
          <h6 class="color-kero text-center font-weight-bold mb-4 f-8">Ingresa para administra Trabajadores <br></h6>

          <a id="linkRutClave" href="{{ route('login') }}" class="btn btn-kero btn-block py-2 mt-3" style="text-transform: capitalize;"><i
            class="fas fa-user mr-3"></i>Rut y clave</a>
            <!-- <div class="text-center">
              <a href="#" style="text-decoration:underline #727272;"><span class="o">Si no tienes cuenta registrate aquí</span> </a>
            </div> -->
            <div class="row align-items-center">
              <div class="col d-none d-sm-none d-md-block">
                <hr>
              </div>
              <div class="col text-center">
                <span class="o">o ingresa con</span> 
              </div>
              <div class="col d-none d-sm-none d-md-block">
                <hr>
              </div>
            </div>
          
            <!-- <a href="#" data-toggle="modal" data-target="#modallogin" class="btn btn-kero btn-block py-2 mt-3" style="text-transform: capitalize;"><i
              class="fas fa-user mr-3"></i>Tu Rut y Clave</a> -->

              
        </div>
        <div class="card-footer border text-center mb-0 pb-0">
          <p class="color-kero" style="font-size: .69rem;font-weight: 700!important;margin-bottom: 0px;">Si tienes dudas llámanos al</p> 
          <h5 class="color-primary"><a class="color-secondary" style="font-size: 1.5rem;font-weight: 700!important" href="tel:+56968954365"><i class="fas fa-phone flip mr-1"></i>968954365</a></h5> 
        </div>
      </div>
    </div>
    </div>
    </div>  
  </div>
  <!-- /Modal -->