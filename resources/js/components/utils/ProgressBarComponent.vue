<template>
    <div id="loading-bar-container">
        <div class="container-bar">
            <div style="display:none;">{{ percentVal }}%</div>
            <div class="loading-bar">
                <div v-bind:class="[percentage == 0 ? 'zeropercent' : percentage < 100 ? 'percentage' : 'fullpercent']" :style="{'width' : percentage + '%'}">
                  <span style="padding-left:4px;padding-left: 11px;line-height: 27px; color:white;">{{stringBar}}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {

    props: ['percent', 'stringBar'],
    data(){
        return {
            percentage: 0,
        }
    },
    computed: {
        percentVal() {
            this.percentage = this.percent;
            return this.percentage.toFixed();
        }
    }
}
</script>
<style lang="scss">



.loading-bar {
  position: relative;
  /*width: 400px;*/
  height: 30px;
  border-radius: 15px;
  overflow: hidden;
  border-bottom: 1px solid #ddd;
  box-shadow: inset 0 1px 2px rgba($color: #000, $alpha: .4), 
    0 -1px 1px #fff, 0 1px 0 #fff;

  .percentage {
    position: absolute;
    top: 1px; left: 1px; right: 1px;
    display: block;
    height: 100%;
    border-radius: 15px;
    background-color: #a5df41;
    background-size: 30px 30px;
    background-image: linear-gradient(135deg, rgba($color: #fff, $alpha: .15) 25%, transparent 25%,
      transparent 50%, rgba($color: #fff, $alpha: .15) 50%,
      rgba($color: #fff, $alpha: .15) 75%, transparent 75%,
      transparent); 
    animation: animate-stripes 3s linear infinite;
    transition: width 0.5s;
  }
  
  .fullpercent{
    position: absolute;
    top: 1px; left: 1px; right: 1px;
    display: block;
    height: 100%;
    border-radius: 15px;
    background-color: #81B622;
    background-size: 30px 30px;
    transition: width 0.5s;    
  }

  .zeropercent{
    position: absolute;
    top: 1px; left: 1px; right: 1px;
    display: block;
    height: 100%;
    border-radius: 15px;
    background-color: #81B622;
    background-size: 30px 30px;
  }
}

@keyframes animate-stripes {
  0% { background-position: 0 0; }
  100% { background-position: 60px 0; }
}
</style>