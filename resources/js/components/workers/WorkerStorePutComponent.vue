<template>
    <div>
        <b-modal id="modal-create-edit-worker" ref="modal-create-edit-worker" size="lg" :title="accionTitle" modal-footer="no">
        
            <div v-if="showWorker" class="modal-body">
                <div class="form-row">           

                    <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="name">Nombre</label>
                        <input type="text" id="name" name="name" v-model="state.name" placeholder="Nombre" autocomplete="nope"  class="form-control" />
                        <div v-if="v$.name.$error" class="error text-danger">{{ v$.name.$errors[0].$message }}</div>
                        
                    </div>            
                    <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="email">Email</label>
                        <input type="text" id="email" name="email" v-model="state.email" class="form-control">
                        <div v-if="v$.email.$error" class="error text-danger">{{ v$.email.$errors[0].$message }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="birthdate">Nacimiento</label>
                        <input type="date" id="birthdate" name="birthdate" v-model="state.birthdate" placeholder="Fecha de Nacimiento" autocomplete="nope"  class="form-control" />
                        <div v-if="v$.birthdate.$error" class="error text-danger">{{ v$.birthdate.$errors[0].$message }}</div>
                        
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="birthdate">Estado</label>
                        <b-form-checkbox v-model="state.active" name="check-button" switch>
                        {{ state.active ? 'Activo' : 'Inactivo' }}
                        </b-form-checkbox>
                    </div>            
                    <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="password">Password</label>
                        <input type="password" id="password" name="password" v-model="state.password" placeholder="Password" autocomplete="nope"  class="form-control" />
                        <div v-if="v$.password.$error" class="error text-danger">{{ v$.password.$errors[0].$message }}</div>
                        
                    </div>
                        <div class="form-group col-md-6">
                        <label class="text-8 text-muted font-weight-bold mb-0" for="confirm">Repetir</label>
                        <input type="password" id="confirm" name="confirm" v-model="state.confirm" placeholder="Repetir" autocomplete="nope"  class="form-control" />
                        <div v-if="v$.confirm.$error" class="error text-danger">{{ v$.confirm.$errors[0].$message }}</div>
                        
                    </div>                      
                </div>
            </div>
        
            <template #modal-footer>
                            
                    <b-button class="btn btn-secondary" @click="hideModal">Cerrar</b-button>
                    <b-button variant="primary" class="btn btn-primary" @click="enviarForm">Enviar</b-button>
                    
            </template>
        

        </b-modal>
        <b-modal id="alert-delete-worker" ref="alert-delete-worker" size="lg" :title="accionTitle" modal-footer="no">
        
            <div class="modal-body">
                <div class="form-row">           
                    <h4>¿Está seguro de eliminar este usuario?</h4>

                </div>
            </div>
        
            <template #modal-footer>
                            
                    <b-button class="btn btn-secondary" @click="hideModalDelete">Cerrar</b-button>
                    <b-button variant="primary" class="btn btn-primary" @click="deleteWorker">Eliminar</b-button>
                    
            </template>
        

        </b-modal>
        <b-modal id="bv-modal-alerta" ref="bv-modal-alerta" hide-footer>
            <template #modal-title>
                Alerta
            </template>
            <div class="d-block text-center">
                <h4>{{message}}</h4>
            </div>
            <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-alerta')">Cerrar</b-button>
        </b-modal>

        <b-modal id="bv-modal-delete-exitosa" ref="bv-modal-delete-exitosa" @hidden="emmitClose" hide-footer>
            <template #modal-title>
                Alerta
            </template>
            <div class="d-block text-center">
                <h4>{{message}}</h4>
            </div>
            <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-delete-exitosa')">Cerrar</b-button>
        </b-modal>
    </div>
</template>
<script>

import useVuelidate from '@vuelidate/core';
import { required, minLength, email, sameAs, helpers } from '@vuelidate/validators';
import { reactive, computed } from '@vue/composition-api';

export default {
    props: ['showWorker', 'routeWorkers', 'secret', 'create'],
    data(){
        return {
            request: null,
            requests: [],
            message: '',
            accionTitle: 'Editar Trabajador'
        }
    },
    setup() { 
        const state = reactive({
            name:'',
            email:'',
            birthdate: '',
            active:true,
            password:'',
            confirm: '',
        });

        const rules = computed(()=> {
            return {
                name: { required: helpers.withMessage('Nombres es requerido', required) },
                email: {
                    required: helpers.withMessage('Email es requerido', required), 
                    email: helpers.withMessage('Ingrese un email válido', email), 
                },
                birthdate: { 
                    required: helpers.withMessage('Nacimiento es requerido', required),
                    isLegalAge: helpers.withMessage('Debe ser Mayor de edad',Vue.prototype.$isLegalAge), 
                },
                active: { required: helpers.withMessage('Estado es requerido', required) },
                password: { 
                    required: helpers.withMessage('Password es requerido', required),
                    passwordMediumLevel: helpers.withMessage('Debe contener mínimo 6 carácteres, mínimo 1 minúscula, 1 mayúscula y 1 número',Vue.prototype.$passwordMediumLevel),
                },
                confirm: {
                    required: helpers.withMessage('Repetir es requerido', required), 
                    sameAs: helpers.withMessage('Debe coincidir con password ingresado', sameAs(state.password)) 
                }
            }
        })
        
        const v$ = useVuelidate(rules, state);


        return {
            state,
            v$,
        }
        
    },
    mounted(){
        
    },
    methods: {
        show(){
            
            if(!this.create){
                this.accionTitle = 'Editar Trabajador';

                this.state.name = this.showWorker.name;
                this.state.email = this.showWorker.email;
                this.state.birthdate = this.showWorker.birthdate;
                this.state.active = this.showWorker.active==1 ? true : false;
            } else {

                this.state.name = '';
                this.state.email = '';
                this.state.birthdate = '';
                this.state.active = true;

                this.accionTitle = 'Crear Trabajador'
            }

            this.v$.$reset();

            this.state.password = '';
            this.state.confirm = '';
            this.$refs['modal-create-edit-worker'].show();
        },
        showDelete(){
            this.$refs['alert-delete-worker'].show();
        },
        hideModalDelete(){
            this.$refs['alert-delete-worker'].hide();
        },
        hideModal(){
            
            this.$refs['modal-create-edit-worker'].hide();
        },
        enviarForm(){
            
            this.v$.$validate();
            if(!this.v$.$error){
                if(this.create){
                    this.createWorker();
                } else {
                    this.editWorker();
                }
                
            }
        },
        editWorker(){
            this.editWorkerAxios(this.showWorker.id).then(data => {

                if( data.data.hasOwnProperty('data') ){
                    
                    this.message = 'Datos actualizados con éxito';
                    this.hideModal();
                    this.$refs['bv-modal-alerta'].show();
                    this.$root.$emit('worker-created-updated');
                    
                } else {
                    this.message = 'No se pudo realizar la acción';
                    this.hideModal();
                    this.$bvModal.show('bv-modal-alerta');                    
                }
                
            })
            .catch(err => console.log(err))
        },
        editWorkerAxios(id){

            
            let params = {
                name        :this.state.name,
                email       :this.state.email,
                birthdate   :this.state.birthdate,
                active      :this.state.active ? 1 : 0,
                password    :this.state.password
            };
   
            
            return axios.put(this.routeWorkers+'/'+id, params, {
                headers: {
                    'x-ccloud-auth': this.secret,
                }
            }).then(function (response) {
                
                console.log('response',response);

            return response;
            
            }).catch(function (error) {
            
            return error;
            });
        },
        createWorker(){
            this.createWorkerAxios().then(data => {

                if( data.data.hasOwnProperty('data') ){
                    
                    this.message = 'Usuario creado con éxito';
                    this.hideModal();
                    this.$refs['bv-modal-alerta'].show();
                    this.$root.$emit('worker-created-updated');
                    
                } else {
                    this.message = 'No se pudo realizar la acción';
                    this.hideModal();
                    this.$bvModal.show('bv-modal-alerta');                    
                }
                
            })
            .catch(err => console.log(err))
        },
        createWorkerAxios(){

            
            let params = {
                name        :this.state.name,
                email       :this.state.email,
                birthdate   :this.state.birthdate,
                active      :this.state.active ? 1 : 0,
                password    :this.state.password
            };
   
            
            return axios.post(this.routeWorkers, params, {
                headers: {
                    'x-ccloud-auth': this.secret,
                }
            }).then(function (response) {
                
                console.log('response',response);

            return response;
            
            }).catch(function (error) {
            
            return error;
            });
        },
        deleteWorker(){
            this.deleteWorkerAxios(this.showWorker.id).then(data => {

                if( data.data.hasOwnProperty('data') ){
                    
                    this.message = 'Usuario eliminado con éxito';
                    this.$refs['alert-delete-worker'].hide();
                    this.$refs['bv-modal-delete-exitosa'].show();
                   
                    
                    
                    
                } else {
                    this.message = 'No se pudo realizar la acción';
                    this.$refs['alert-delete-worker'].hide();
                    this.$bvModal.show('bv-modal-alerta');                    
                }
                
            })
            .catch(err => console.log(err))
        },
        emmitClose(){
            this.$root.$emit('worker-created-updated');
        },
        deleteWorkerAxios(id){
            return axios.delete(this.routeWorkers+'/'+id, {
                headers: {
                    'x-ccloud-auth': this.secret,
                }
            }).then(function (response) {
                
                console.log('response',response);

            return response;
            
            }).catch(function (error) {
            
            return error;
            });
        },
    }
}
</script>