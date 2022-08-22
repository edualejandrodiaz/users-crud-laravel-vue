/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

import { BSpinner } from 'bootstrap-vue'
Vue.component('b-spinner', BSpinner)

import { BOverlay } from 'bootstrap-vue'
Vue.component('b-overlay', BOverlay)

import vueNumeralFilterInstaller from 'vue-numeral-filter';
 
Vue.use(vueNumeralFilterInstaller, { locale: 'es' });



import vSelect from 'vue-select';

Vue.component('v-select', vSelect);

import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'

Vue.use(Autocomplete);



import vWow from 'v-wow'
Vue.use(vWow);




Vue.use(require('vue-moment'));


import Pagination from 'vue-pagination-2';

Vue.component('pagination', Pagination);




Vue.component('landing-component', require('./components/LandingComponent.vue').default);
Vue.component('login-component', require('./components/auth/LoginComponent.vue').default);
Vue.component('ini-session-component', require('./components/auth/IniSessionComponent.vue').default);




Vue.component('workers-component', require('./components/workers/WorkersComponent.vue').default);
Vue.component('worker-component', require('./components/workers/WorkerOneComponent.vue').default);
Vue.component('show-worker-modal', require('./components/workers/WorkerShowModalComponent.vue').default);
Vue.component('worker-store-put-component', require('./components/workers/WorkerStorePutComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.prototype.$validaRut = (rutCompleto) => {
    console.log('antes', rutCompleto);
    rutCompleto = rutCompleto.replace(/[\[\].]+/g,"");
    rutCompleto = rutCompleto.replace('-','');
    console.log('despues', rutCompleto);
    if (!/^[0-9]+[0-9kK]{1}$/.test( rutCompleto ))
        return false;
    
    var digv    = rutCompleto.slice(-1);
    var rut     = rutCompleto.slice(0, -1);
    if ( digv == 'K' ) digv = 'k' ;



    return ( Vue.prototype.$dvrut(rut) == digv );
}

Vue.prototype.$dvrut = (T) => {
    var M=0,S=1;
    for(;T;T=Math.floor(T/10))
    S=(S+T%10*(9-M++%6))%11;
    return S?S-1:'k';
}


Vue.prototype.$isGreaterThanTodayDate = (mysqlDate) => {
    
    let datNew = new Date();
    
    let d = datNew.getDate();
    let m = datNew.getMonth() + 1;
    let Y = datNew.getFullYear();

    return new Date(mysqlDate) >= new Date(Y+'-'+m+'-'+d);
}

Vue.prototype.$isLegalAge = (mysqlDate) => {

    let ageDifMs    = Date.now() - (new Date(mysqlDate) );
    let ageDate     = new Date(ageDifMs);

    return ageDate.getUTCFullYear() - 1970 > 18;
    
}

Vue.prototype.$passwordMediumLevel = (pass) => {

    let regex   = new RegExp("((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,}))");

    return regex.test(pass);
    
}



 Vue.mixin({
    data(){
        return {
            globalRequest: false,
            globalRequests: [],
        }
    },
     methods: {
         globalHelper: function () {
             alert("Hello world")
         },

        formatRut(number) {


            return number
            .replace(/[^0-9]/g, '')
            .replace( /^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')
        },
        globalClearOldRequest(msg) {
            if(this.globalRequest){
                this.globalRequest.msg = msg;
                this.globalRequests.push(this.globalRequest);
                this.globalRequest = null;
            }
        },
        globalModalLoginRedirectToCart(){
            let link1 = document.getElementById('linkRutClave').href;
            let url1 = new URL(link1);
            url1.searchParams.set('redirectTo', 'cart');
            document.getElementById('linkRutClave').href = url1;
  
            let link2 = document.getElementById('linkLoginFacebook').href;
            let url2 = new URL(link2);
            url2.searchParams.set('redirectTo', 'cart');
            document.getElementById('linkLoginFacebook').href = url2;
  
            let link3 = document.getElementById('linkLoginGoogle').href;
            let url3 = new URL(link3);
            url3.searchParams.set('redirectTo', 'cart');
            document.getElementById('linkLoginGoogle').href = url3;
  
            $('#modallogin').modal('show');
        },
        globalModalLoginRedirectToProducts(){
            let link1 = document.getElementById('linkRutClave').href;
            let url1 = new URL(link1);
            url1.searchParams.set('redirectTo', 'products');
            document.getElementById('linkRutClave').href = url1;
  
            let link2 = document.getElementById('linkLoginFacebook').href;
            let url2 = new URL(link2);
            url2.searchParams.set('redirectTo', 'products');
            document.getElementById('linkLoginFacebook').href = url2;
  
            let link3 = document.getElementById('linkLoginGoogle').href;
            let url3 = new URL(link3);
            url3.searchParams.set('redirectTo', 'products');
            document.getElementById('linkLoginGoogle').href = url3;
  
            $('#modallogin').modal('show');
        },
     },
  })


const app = new Vue({
    el: '#app',
});
