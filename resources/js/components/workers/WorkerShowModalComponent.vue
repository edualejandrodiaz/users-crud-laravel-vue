<template>

    <b-modal id="modal-worker" ref="modal-worker" size="lg" title="Trabajador" modal-footer="no">
    
        <div v-if="showWorker" class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="text-8 text-muted font-weight-bold mb-0" for="idWorker">ID</label>
                    <span id="idWorker" class="text-8 color-tertiary d-block">{{ showWorker.id }}</span>
                    
                </div>            
                <div class="form-group col-md-6">
                    <label class="text-8 text-muted font-weight-bold mb-0" for="name">Estado</label>
                    <span id="nameWorker" class="text-8 color-tertiary d-block">
                        <template v-if="showWorker.active==1">                                      
                            <i class="fas fa-circle color-green"></i> Activo
                        </template>
                        <template v-else>
                            <i class="fas fa-circle color-red"></i> Inactivo     
                        </template>
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="text-8 text-muted font-weight-bold mb-0" for="idWorker">Nombre</label>
                    <span id="idWorker" class="text-8 color-tertiary d-block">{{ showWorker.name }}</span>
                    
                </div>            
                <div class="form-group col-md-6">
                    <label class="text-8 text-muted font-weight-bold mb-0" for="name">Email</label>
                    <span id="nameWorker" class="text-8 color-tertiary d-block">{{ showWorker.email }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="text-8 text-muted font-weight-bold mb-0" for="idWorker">Nacimiento</label>
                    <span id="idWorker" class="text-8 color-tertiary d-block">{{ showWorker.birthdate | moment('DD/MM/YYYY') }}.</span>
                    
                </div>            
                                            
            </div>
        </div>
    
        <template #modal-footer>
                        
                <b-button class="btn btn-secondary" @click="hideModal">Cerrar</b-button>
                
        </template>
    

    </b-modal>

</template>
<script>
export default {
    props: ['showWorker'],
    data(){
        return {
            request: null,
            requests: [],
        }
    },
    mounted(){
        
    },
    methods: {
        show(){
            this.$refs['modal-worker'].show();
        },
        hideModal(){
            
            this.$refs['modal-worker'].hide();
        },
    }
}
</script>

