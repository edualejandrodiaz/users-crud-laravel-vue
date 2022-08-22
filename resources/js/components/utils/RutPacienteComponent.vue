<template>
  <b-overlay :show="loading" :variant="'white'" rounded="sm">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="rut_paciente" class="color-primary text-8 font-weight-bold">RUT Paciente</label>
          <div class="custom-file">
            <div class="row">
              <div class="col-8">
                <input type="text" id="rut_paciente" name="rut_paciente" @input="rutPaciente()" v-model="formatedRut" placeholder="RUT" autocomplete="nope"  class="form-control" />
              </div>
              <div class="col-4">
                <!-- <b-button type="button" class="btn btn-file" size="sm" variant="info" v-on:click="upForm()"><i class="fa fa-file" aria-hidden="true"></i> Crear</b-button> -->
              </div>
            </div>
          </div>
          
        </div>

      </div>
    </div>
  </b-overlay>
</template>
<script>
export default {
    props: ['rut'],
    data(){
      return {
        rut_paciente:'',
        loading:false,
      }
    },
    mounted() {
      
    },
    methods: {
      upForm(){
       
        
      },
      rutPaciente(){
        let rut = this.rut_paciente;
        console.log('rut',rut);
        if(rut && rut!=''){
          let rutNew = rut.replace(/[.-]/g, '');
          
          console.log('rutNew',rutNew);
          this.$root.$emit('rut-paciente-event-receta', rutNew) //like this
        }
        
      }
    },
    computed: {
        formatedRut: {
            get() {
                return this.formatRut(this.rut_paciente);
            },
            set(modifiedValue) {
                this.rut_paciente =  modifiedValue;
                console.log('modifiedValue', modifiedValue);
            },
        },
    }
    
}
</script>
<style lang="scss">
  .btn-file {
    height: calc(1.5em + 0.75rem + 7px);
    margin:0;
  }
</style>