<template>
    <div class="col-md-12 py-1">
        <div class="card shadow-none border bg-opacity">
            <div class="card-body py-2">
                <div class="row">
                    <div class="col-12 col-md-2 text-sm-center">
                        <span class="text-8 text-muted font-weight-bold">ID User</span>
                        <br>
                        <span class="text-8 color-tertiary">{{ worker.id }}</span>
                        <hr class="d-block d-sm-block d-md-none">
                    </div>
                    <div class="col-6 col-md-2">
                        
                        
                            
                            <template v-if="worker.active==1">
                                
                                    <div class="row align-items-center">
                                        <div class="col-3 text-right d-none d-sm-none d-md-block">
                                            <i class="fas fa-circle color-green"></i>
                                        </div> 
                                        <div class="col-8">
                                            <span class="text-8 text-muted font-weight-bold">Estado</span> <br> 
                                            <span class="text-8 color-tertiary">Activo</span>
                                        </div>
                                    </div>

                            </template>
                            <template v-else>
                                
                                    <div class="row align-items-center">
                                        <div class="col-3 text-right d-none d-sm-none d-md-block">
                                            <i class="fas fa-circle color-red"></i>
                                        </div> 
                                        <div class="col-8">
                                            <span class="text-8 text-muted font-weight-bold">Estado</span> <br> 
                                            <span class="text-8 color-tertiary">Inactivo</span>
                                        </div>
                                    </div>
                                    
                            </template>


                            

                        
                        
                
                    </div>
                    <div class="col-6 col-md-3">
                        <span class="text-8 text-muted font-weight-bold">Nombre</span>
                        <br>
                        <span class="text-8 color-tertiary">{{ worker.name }}</span>
                    </div>
                    <div class="col-6 col-md-3">
                        <span class="text-8 text-muted font-weight-bold">Email</span>
                        <br>
                        <span class="text-8 color-tertiary">{{ worker.email }}</span>
                    </div>
                    <div class="col-6 col-md-2">
                        <span class="text-8 text-muted font-weight-bold">Nac.</span>
                        <br>
                        <span class="text-8 color-tertiary">{{ worker.birthdate | moment('DD/MM/YYYY') }}.</span>
                    </div>
                    <div class="col-12">
                        <hr style="margin-bottom: 0px;">
                    </div>
                    <div class="col-12 col-md-6">
                        <span class="text-4 text-muted align-middle">Ingresado:&nbsp;&nbsp;</span>
                        
                        <span class="text-4 text-muted align-middle">

                            {{ worker.created_at | moment('DD/MM/YYYY HH:mm:ss') }}

                        </span>
                        <br>
                        <span class="text-4 text-muted align-middle">Modificado:</span>
                        
                        <span class="text-4 text-muted align-middle">

                            {{ worker.updated_at | moment('DD/MM/YYYY HH:mm:ss') }}

                        </span>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        
                        
                        <b-button variant="outline-info" size="sm" class="mt-2" @click="viewWorker(worker.id)"><i class="fas fa-search"></i></b-button>
                        <b-button variant="outline-primary" size="sm" class="mt-2" @click="editWorker(worker.id)"><i class="fas fa-edit"></i></b-button>
                        <b-button variant="outline-danger" size="sm" class="mt-2" @click="deleteWorker()"><i class="fas fa-trash"></i></b-button>
                    </div>

                </div>
            </div>
        </div>



        <show-worker-modal ref="modalShowWorker" :show-worker="showWorker"></show-worker-modal>
        
        <worker-store-put-component ref="storePutWorker" :route-workers="routeWorkers" :secret="secret" :show-worker="showWorker" :create="false"></worker-store-put-component>
    </div>
</template>
<script>


export default {
    props: ['worker', 'routeWorkers', 'secret'],
    data(){
        return {
            showWorker: {id:0,name:''},
            request: null,
            requests: [],
        }
    },
    mounted(){
        this.showWorker = this.worker;
    },
    methods: {
        viewWorker($event){

            this.$emit('showEvent', true);

            this.getWorkerByIDAxios($event).then(data => {

                if( data.data.hasOwnProperty('data') ){
                    this.$emit('showEvent', false);
                    this.showWorker=data.data.data;
                    this.$refs['modalShowWorker'].show();
                }
            
            })
            .catch(err => console.log(err))
        },
        editWorker($event){

            this.$emit('showEvent', true);

            this.getWorkerByIDAxios($event).then(data => {

                if( data.data.hasOwnProperty('data') ){
                    this.$emit('showEvent', false);
                    this.showWorker=data.data.data;
                    
                    this.$refs['storePutWorker'].show();
                }
            
            })
            .catch(err => console.log(err))
        },
        deleteWorker(){
            this.showWorker=this.worker;
            this.$refs['storePutWorker'].showDelete();
        },
        getWorkerByIDAxios(id){

            
            let params = {};
   
            const axiosSource = axios.CancelToken.source();
            this.request = { cancel: axiosSource.cancel, msg: "Loading..." };

            params.cancelToken = axiosSource.token;
            let self = this;
            return axios.get(this.routeWorkers+'/'+id, {
                params: params,
                headers: {
                    'x-ccloud-auth': this.secret,
                }
            }).then(function (response) {
                self.clearOldRequest("Success");
                console.log('response',response);

            return response;
            
            }).catch(function (error) {
            
            return error;
            });
        },
        cancel(){
            this.request.cancel();
            this.clearOldRequest("Cancelled")
        },
        clearOldRequest(msg) {
            if(this.request){
                this.request.msg = msg;
                this.requests.push(this.request);
                this.request = null;
            }
        }

    }
}

</script>