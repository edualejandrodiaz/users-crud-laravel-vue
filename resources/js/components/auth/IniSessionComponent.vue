<template>
    <button @click="iniSession()" class="btn-login-logout btn-sm btn-rounded btn-secondary px-0 text-capitalize waves-effect waves-light" style="font-size: 15px;max-width: 160px;min-width: 159px;">Iniciar sesión</button>
</template>
<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
    setup() {
        
    },
    mounted(){

    },
    methods: {
        iniSession(){
            if(location.pathname=='/cart/0'){
                this.globalModalLoginRedirectToCart();
            } else if(location.pathname=='/productos'){
                this.globalModalLoginRedirectToProducts();
            } else {
                $('#modallogin').modal('show');
            }
        }
    }

})
</script>
