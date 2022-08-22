<template>
    <div class="container-xxl bg-white p-0">
    
        <!-- Spinner Start -->
        <div v-if="!loaded" id="spinner" class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">cargando...</span>
            </div>
        </div>
        <!-- Spinner End -->
        

        <!-- Navbar & Hero Start -->
        <div v-if="loaded" class="container-xxl p-0" id="home">


            <div class="container-xxl py-md-5" style="background-color: #fafafa;">
                <div class="container py-5">
                    <div class="row g-5 align-items-center  justify-content-center">
                        <div class="col-md-2 text-center text-lg-start">
                            <img src="img/logo-calidad-cloud.webp" width="150px" class="py-2" alt="Logo">
                            
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4 mt-3 animated slideInDown" style="color:#ff344c; font-weight: normal;">
                                Ingresa a tus trabajadores <br> en muy pocos pasos</h4>
                           
                        </div>
                    
                    </div>
                </div>

                <div class="row mx-3 mt-2">   
                    <div class="col-md-4 mt-4">            
                                <div class="container shadow" style="border-radius: 15px; min-height: 265px; background-color: #ffffff;">
                                    <div class="row align-items-center justify-content-center text-center">
                                    <h3 class="mb-0 mt-n5 shadow p-4 mt-3" style="background-color: #ffffff; border-radius:100px; width: 80px;">01</h3>
                                    </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-md-6 mx-0 px-0 wow fadeInUp" v-wow data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <img class="img-fluid" src="img/doc.png">
                                    </div>
                                    <div class="col-md-6 wow fadeInUp mx-0 py-0" v-wow data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <div class="d-flex align-items-center mb-4">
                                            
                                            <h5 class="mb-0 mt-3"> Acceso</h5>
                                        </div>
                                        <p class="mb-2" style="font-size: 15px">Contactate con el administrador para tener tu cuenta de acceso.</p>
                                        </div>
                                </div>
                                </div>
                            </div>   
                            <div class="col-md-4 mt-4">           
                                <div class="container shadow" style="border-radius: 15px; min-height: 265px; background-color: #ffffff;">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <h3 class="mb-0 mt-n5 shadow p-4 mt-3" style="background-color: #ffffff; border-radius:100px; width: 80px;">02</h3>
                                        </div>
                                <div class="row py-3">
                                    <div class="col-md-6 mx-0 px-0 wow fadeInUp" v-wow data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <img class="img-fluid" src="img/workers.png">
                                    </div>

                                    <div class="col-md-6 mx-0 px-1 wow fadeInUp" v-wow data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <div class="d-flex align-items-center mb-4">
                                            <h5 class="mb-0 mt-3">Mis Trabajadores</h5>
                                        </div>
                                        <p class="mb-2" style="font-size: 15px">En mis trabajadores podrás ver toda tu planilla, podrás igualmente administrar los usuarios registrados.</p>
                                        </div>

                                </div>
                            </div>
                        </div>   
                        <div class="col-md-4 mt-4">  
                                <div class="container shadow" style="border-radius: 15px; min-height: 265px; background-color: #ffffff;">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <h3 class="mb-0 mt-n5 shadow p-4  mt-3" style="background-color: #ffffff; border-radius:100px; width: 80px;">03</h3>
                                        </div>
                                <div class="row py-3 align-items-center">
                                    <div class="col-md-6 mx-0 px-0 wow fadeInUp" v-wow data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <img class="img-fluid" src="img/espe.png">
                                    </div>
                                    <div class="col-md-6 mx-0 px-1 wow fadeInUp" v-wow data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <div class="d-flex align-items-center mb-4">
                                            <h5 class="mb-0 mt-3">Soporte</h5>
                                        </div>
                                        <p class="mb-2" style="font-size: 15px">Si tienes algún inconveniente, envíanos un mail y nos contactaremos contigo.</p>
                                        </div>
                                </div>
                        
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <!-- Navbar & Hero End -->






        



    

    
    </div>
</template>
<script>
export default {
    props: ['routePedidoEspecial'],
    data(){
        return {
            loaded: false,
        }
    },
    mounted() {
        setTimeout(()=>{
            this.loaded = true;
        }, 2000);
    },
    methods: {
        goToTheProduct(product){
            console.log('producto uno ', product.id);
            location = location.origin+'/product-detail/'+product.id;
        },
        searchByWord(value){
            console.log('search ingredient ',value);
            location = location.origin+'/productos?search='+value;
        },
        specialOrder(value){
            console.log('pedido especial', value);
            this.$refs.pedidoEspecial.upModalPedidoEspecial();
        }
    }
}
</script>
