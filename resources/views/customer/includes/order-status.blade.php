
<h5 class="color-primary font-weight-normal">Estado Pedido</h5>
@switch($status)
  @case(1)
    <p class="text-8 grey-text">
    <i class="fas fa-circle color-red"></i>
    <span class="text-8 color-primary">Programado</span>
    </p>
    @break;
   @case(2)
    <p class="text-8 grey-text">
    <i class="fas fa-circle color-orange"></i>
    <span class="text-8 color-primary">En Ruta</span>
    </p>
    @break;
 @case(3)
    <p class="text-8 grey-text">
    <i class="fas fa-check-circle color-green"></i>
    <span class="text-8 color-primary">Entregado</span>
    </p>
    @break
@case(4)
    <p class="text-8 grey-text">
    <i class="fas fa-times-circle color-yellow"></i>
    <span class="text-8 color-primary">Anulado</span>
    </p>
    @break
@case(7)
    <p class="text-8 grey-text">
    <i class="fas fa-exclamation-circle color-yellow"></i>
    <span class="text-8 color-primary">Webpay Pendiente</span>
    </p>
    @break
@case(9)
    <p class="text-8 grey-text">
    <i class="fas fa-exclamation-circle color-yellow"></i>
    <span class="text-8 color-primary">Webpay Fallido</span>
    </p>
    @break
@case(10)
    <p class="text-8 grey-text">
    <i class="fas fa-ban color-red"></i>
    <span class="text-8 color-primary">Abortado</span>
    </p>
    @break
@case(11)
    <p class="text-8 grey-text">
    <i class="fas fa-ban color-red"></i>
    <span class="text-8 color-primary">Cancelado Webpay</span>
    </p>
    @break
@default
    <p class="text-8 grey-text">
    <i class="fas fa-circle color-blue"></i>
    <span class="text-8 color-primary font-weight-bold">Estado</span>
    </p>
    Indeterminado
@endswitch
