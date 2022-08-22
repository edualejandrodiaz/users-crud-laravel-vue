<template>
    <div class="boxLogin card-body py-0">
        <transition name="fadeauth" v-on:after-enter="afterEnterAuth" v-on:after-leave="afterLeaveAuth">
            <div v-if="auth==2" class="card-body text-center text-success">
                <h4>Credenciales válidas, redireccionando</h4>
                <b-spinner variant="success" label="Cargando"></b-spinner>
            </div>
            <div v-if="auth==1" class="card-body text-center text-danger">
                <h4>Usuario o Password Inválido</h4>
                <button type="button" @click="retry" class="btn btn-primary">
                                Reintentar
                </button>
            </div>
        </transition>
        <transition name="fadeedu"  v-on:after-leave="afterLeaveLogin">
            <div v-if="login" class="card-body text-center">
                <h4>Autentificando</h4>
                <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow"></b-spinner>
            </div>
        </transition>
        <transition name="fade"  v-on:after-leave="afterLeave">
            <div v-if="show" class="card-body">
                <form method="POST" :action="routeLogin">
                    

                    <div class="form-group row">
                        <label for="rut" class="col-md-4 col-form-label text-md-right">RUT</label>

                        <div class="col-md-6">
                            <input id="rut" type="rut" v-model="formatedRut" class="form-control" name="rut" required autocomplete="rut" autofocus>
                            <div v-if="v$.rut.$error" class="error text-danger">{{ v$.rut.$errors[0].$message }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" v-model="state.password" class="form-control" name="password" required autocomplete="current-password">
                            <div v-if="v$.password.$error" class="error text-danger">{{ v$.password.$errors[0].$message }}</div>
                        </div>
                    </div>

                    <div class="form-group row my-4">
                        
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" @click="submitForm" class="btn btn-primary">
                                Login
                            </button>

                            
                                <a class="btn btn-link" v-bind:href="routeReset">
                                    ¿Olvidó su contraseña?
                                </a>
                            
                        </div>
                    </div>
                </form>
            </div>
        </transition>
    </div>
</template>

<script>
    import useVuelidate from '@vuelidate/core';
    import { required, minLength, helpers } from '@vuelidate/validators';
    import { reactive, computed } from '@vue/composition-api';

const mustBeCool = (value) => value.indexOf('cool') >= 0




    
    export default {

        props: ['routeLogin', 'routeHome', 'routeReset', 'routeRedirect','token'],
        data(){
            return {
                //v$: useValidate(),
               show: false,
               login: false,
               authState: false,
               auth: 0
                
            }

        },
        setup() { 
            const state = reactive({
                rut: '',
                password: '',
            });

            const rules = computed(()=> {
                return {
                    rut: {
                        required, 
                        minLength: minLength(6), 
                        validaRut: helpers.withMessage('Rut no válido',Vue.prototype.$validaRut) 
                    },
                    password: {required}
                }
            })
            
            const v$ = useVuelidate(rules, state);


            return {
                state,
                v$,
                remember: ''
            }
            
        },
        mounted() {
            
            console.log('Component mounted.');
            this.show = true;
        },
        computed: {
            formatedRut: {
                get() {
                    return this.formatRut(this.state.rut);
                },
                set(modifiedValue) {
                    //this.rut = modifiedValue;
                    this.state.rut =  modifiedValue;
                    console.log('modifiedValue', modifiedValue);
                },
            },
        },
        methods: {
            submitForm(){
                //this.v$.$touch()
                this.v$.$validate();
                console.log(this.v$);
                console.log('v$.rut.error',this.v$.rut.$error);
                if(!this.v$.$error){
                    this.setBox();
                    this.show = false;
                    //this.doLogin();
                }
                //alert('Form Success submited');
            },
            retry(){
                
                this.authState = false;
                this.auth = 0;
                this.state.password = "";
            },
            setBox(){
                let box = document.querySelector('.boxLogin');
                box.style.height = box.clientHeight+'px';
                
                console.log('box', box.style.height);
                
            },
            doLogin(){

              
              this.doLoginAxios().then(data => {

                this.login = false;

                if( data.hasOwnProperty('status') && data.status==204 ){
                    
                    this.authState=true;
                } 
                
            })
            .catch(err => console.log(err))

            },
            doLoginAxios(){
            
              console.log('this.routeLogin',this.routeLogin);

              return axios.post(this.routeLogin, {
                rut     : this.state.rut,
                password: this.state.password,
                remember: this.remember,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              })
              .then(function (response) {
               
                console.log('response',response);

                return response;
                
              }).catch(function (error) {
                
                return error;
              });
            },
            afterLeave: function (el) {
                this.login = true;
                console.log('Se ha terminado transitions');
                this.doLogin();
            },
            afterEnterAuth: function (el) {
                if(this.auth == 2){
                    if(this.routeRedirect && this.routeRedirect!==''){
                        location = this.routeRedirect;
                    } else {
                        location = this.routeHome;
                    }
                    
                }
            },
            afterLeaveAuth: function (el) {
                this.show = true;
            },
            afterLeaveLogin: function (el) {
                console.log('afterLeaveLogin',this.authState);
                if(this.authState){
                    this.auth = 2;
                } else {
                    this.auth = 1;
                }
            },
        }
    }
</script>
<style lang="scss">

    .fade-enter-active {
        transition: opacity 2s;
    }

    .fade-leave-active {
        transition: opacity 0.5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    .fadeedu-enter-active {
        transition: opacity 0.5s;
    }

    .fadeedu-leave-active {
        transition: opacity 0.5s;
    }
    .fadeedu-enter, .fadeedu-leave-to  {
        opacity: 0;
    }

    .fadeauth-enter-active {
        transition: opacity 2s;
    }

    .fadeauth-leave-active {
        transition: opacity 0.5s;
    }
    .fadeauth-enter, .fadeauth-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    
</style>