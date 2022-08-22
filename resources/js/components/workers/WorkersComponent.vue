<template>

    <!-- Container -->
    <div class="container">
        <div class="row py-4">

    

            <!-- right -->
            <div class="col-md-12">

                <div class="row pb-2">
                    <div class="col-md-6 my-2">
                        <h5 class="color-primary font-weight-normal titulo-grande">Trabajadores</h5>

                    </div>
                    <div class="col-md-6 text-right my2">
                        <b-button variant="primary" size="sm" @click="newWorker()"><i class="fa fa-plus-circle"></i> Nuevo</b-button>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-10">
                        
                        <show-worker-modal ref="modalShowWorker" :show-worker="this.worker"></show-worker-modal>
                        <worker-store-put-component ref="storePutWorker" 
                        :route-workers="routeWorkers" 
                        :secret="secret" 
                        :show-worker="this.worker" :create="true"></worker-store-put-component>
                    </div>
                    <div class="col-md-12">
                        <div class="row mb-md-5">
                        <div class="col-md-8 mx-auto">
                                    
                            <!-- Custom rounded search bars with input group -->
                            <form action="" class="d-none d-md-block">
                            <autocomplete 
                            
                            :search="search" 
                            :get-result-value="getResultValue"
                            :placeholder="'Buscar Trabajador...'" 
                            :debounceTime="200"
                            @submit="submit"
                            ref="autocomplete">
                                <template #result="{ result, props }">
                                    <li v-if="result.name && result.id==0" v-bind="props">
                                        No Encontrado
                                    </li>
                                    <li v-else-if="result.name" v-bind="props">
                                        {{ result.name }} / {{ result.email}}
                                    </li>
                                    <li v-else v-bind="props">
                                        {{ result }}
                                    </li>
                                </template>
                                
                            </autocomplete>
                               
                            </form>
                            
                            <!-- End -->
     
                            
                        </div>

                        </div>
                    </div>

                </div>
                <!-- New Products -->
                <b-overlay :show="loading" :variant="'white'" rounded="sm">
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <template>
                                <div class="col-12 col-md-6 mt-2">
                                    <b-form-checkbox v-model="paginateData" @change="isPaginatedOrScrolling" name="check-button" switch>
                                    Paginación (Turn Off para Scrolling)
                                    </b-form-checkbox>
                                </div>
                            </template>
                            <template v-if="this.paginateData">
                                <div class="col-12 col-md-6 mt-2">
                                    <b-pagination
                                        v-model="currentPage"
                                        :total-rows="pagination.total"
                                        :per-page="pagination.per_page" 
                                        align="right" 
                                        @change="findDataPage"
                                        ></b-pagination>
                                </div>

                            </template>
                        </div>
                    </div>

                </div>
                <div class="row py-4">
                    
                    <!-- Worker One -->
                    <worker-component v-for="worker in workers" :key="worker.id" :worker="worker" 
                    @showEvent="showWorker($event)" 
                    :route-workers="routeWorkers" 
                    :secret="secret"></worker-component>


                    <!-- Worker One -->
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <template v-if="this.paginateData">
                        <b-pagination
                            v-model="currentPage"
                            :total-rows="pagination.total"
                            :per-page="pagination.per_page" 
                            align="right" 
                            @change="findDataPage"
                            ></b-pagination>
                        </template>
                    </div>

                </div>
                </b-overlay>
                <!-- /New Products -->

                <div class="row pt-4">
                    
                    <div class="col-12 col-md-3 text-sm-center">
                    <a @click="scrollToTop()" class="btn btn-default btn-rounded px-0 text-capitalize waves-effect waves-light">Inicio</a>
                    </div>

                </div>

            </div>
            <!-- /right -->

        </div>

    </div>
    <!-- Container -->
    
</template>
<script>
import axios from "axios";
export default {

    props: [ 
    'routeWorkers',
    'secret',
    'routeMoreResults', 'customer', 'find', 'token'],
    data(){
        return {
            products: [],
            worker: {id:0,name:'',email:'',birthdate:'', active:1},
            workers: [],
            paginateData: true,
            pagination: {current_page:1, total_pages:1, total:1, per_page:1},
            currentPage: 1,
            page: 1,
            loading: false,
            scrolledToBottom: false,
            busqueda: '',
            busquedaTxt: '',
            request: null,
            requests: [],
            cancelTokenSource: null            
        }
    },
    mounted() {
        
        if(this.find && this.find!==''){
           
            this.busqueda = this.find;
            
        } else {
            this.getWorkers();
        }
        
        this.scroll();
        

        this.$root.$on('worker-created-updated', () => {
            if(this.paginateData){
                this.getWorkersByPage(this.page);
            } else {
                this.scrollToTop();
                this.getWorkersByPage(1);
            }
            
        });
        
    },
    methods: {
        setBox(){
            let box = document.querySelector('.boxLogin');
            box.style.height = box.clientHeight+'px';
            
            console.log('box', box.style.height);
            
        },
        showWorker($event){

            this.loading = $event;

        },
        newWorker(){
            this.worker={id:0,name:'',email:'',birthdate:'', active:1};
                    
            this.$refs['storePutWorker'].show();
        },
        getWorkers(){

            this.loading = true;

            this.getWorkersAxios().then(data => {

                this.loading = false;
                console.log('getWorkers',data);
                if( data.data.hasOwnProperty('data') ){
                    
                    this.workers=data.data.data;
                    this.pagination=data.data.meta.pagination;
                }
            
            })
            .catch(err => console.log(err))

        },
        getWorkersByPage(page){

            this.loading = true;
            let params = {};
            if(this.busqueda.length > 3){
                params.search = this.busqueda; 
            }

            this.getWorkersAxios(params,page).then(data => {

                this.loading = false;
                console.log('getWorkersByPage',data);
                if( data.data.hasOwnProperty('data') ){

                    if(page==1 || this.paginateData){
                        this.workers = [];
                    }
                    
                    
                    this.workers = this.workers.concat(data.data.data);
                    console.log('this.workers.concat',this.workers)
                    this.pagination=data.data.meta && data.data.meta.pagination ? data.data.meta.pagination : {current_page:1, total_pages:1};
                    this.page = this.pagination.current_page;
                } 
                
            
            })
            .catch(err => console.log(err))

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
        },
        findDataPage($event){
            console.log('page', $event);
            this.getWorkersByPage($event);
        },
        isPaginatedOrScrolling($event){ 
            this.getWorkersByPage(1);
        },
        getWorkersAxios(params, page){

            if(!params){
                params = {}
            }

            if(page && page > 0){
                params.page = page;
            }

   
            const axiosSource = axios.CancelToken.source();
            this.request = { cancel: axiosSource.cancel, msg: "Loading..." };

            params.cancelToken = axiosSource.token;
            let self = this;
            return axios.get(this.routeWorkers, {
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
        search: function(input){
            //https://codepen.io/trevoreyre/pen/JjGxLEm
            //https://autocomplete.trevoreyre.com/#/vue-component
            //https://github.com/trevoreyre/autocomplete
            console.log(input);
            if (input.length < 1 || input=='not found') 
            { 
                return []; 
            }
            
            let results = this.workers.filter(worker => {
                    return worker.name.normalize('NFD').replace(/\p{Diacritic}/gu, "").toLowerCase()
                    .startsWith( input.normalize('NFD').replace(/\p{Diacritic}/gu, "").toLowerCase() ) || 
                    worker.email.normalize('NFD').replace(/\p{Diacritic}/gu, "").toLowerCase()
                    .startsWith( input.normalize('NFD').replace(/\p{Diacritic}/gu, "").toLowerCase() );
            });

            if( results.length > 0 ){
                return results;
            }
            



            return new Promise(resolve => {

                this.searchMoreResultsAxios(input).then(data => {
 
                    if( data.data.hasOwnProperty('data') ){
                        
                        let workers = data.data.data;
                        if(workers.length==0){
                            resolve([{id: 0, name:'not found', email:''}])
                        } else {
                            resolve(workers)
                        }
                        
                    } else {
                        resolve([{id: 0, name:'not found', email:''}]);
                    }

                })
            
            })

            
        },
        getResultValue: function(result){
            
            return result.name;
        },
        submit(result) {
            
            if(result.id && result.id>0){
                
            
                this.worker = result;
                
                this.$refs['modalShowWorker'].show();
            }

           

        },
        busquedaClean(){
            this.busqueda = '';
            if (this.request) this.cancel();
            
            this.loading = true;

            this.products = [];

            if(this.category_id){
                this.productsByCategory(this.category_id, 1);
            } else {
                this.getProductByPage(1);
            }
        },
        searchMoreResults(busqueda){
            
            this.searchMoreResultsAxios(busqueda).then(data => {
 
                if( data.data.hasOwnProperty('data') ){
                    
                    //this.more=data.data.data;
        
                } 

            })
            .catch(err => console.log(err))

        },
        searchMoreResultsAxios(busqueda){



            let params = {
                search: busqueda
            }

   
            const axiosSource = axios.CancelToken.source();
            this.request = { cancel: axiosSource.cancel, msg: "Loading..." };

            params.cancelToken = axiosSource.token;
            let self = this;
            return axios.get(this.routeMoreResults, {
                params: params
            }).then(function (response) {
                self.clearOldRequest("Success");
                console.log('response',response);

            return response;
            
            }).catch(function (error) {
            
            return error;
            });
        
        },
        afterLeave: function (el) {
            
            
        },
        afterEnterAuth: function (el) {
            
        },
        afterLeaveAuth: function (el) {
            
        },
        afterLeaveLogin: function (el) {
           
        },
        scroll () {
            window.onscroll = () => {
                console.log('scroll');
                let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight

                if (bottomOfWindow && !this.paginateData) {
                    this.scrolledToBottom = true // replace it with your code
                    let nextPage = this.page+1;
                    if(nextPage > this.pagination.current_page && nextPage <= this.pagination.total_pages && !this.loading){
                        
                         this.getWorkersByPage(nextPage);
                       
                    }
                     
                }
            }
  	    },
        scrollToTop(){
             window.scrollTo(0, 0);
        }
    }
}
</script>
<style lang="scss">
.autocomplete-input {
    background-color: #fff;
}
.custom-control {
    z-index:0;
}
</style>