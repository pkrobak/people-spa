import './bootstrap'
import Vue from 'vue'
import './validator/rules';
import VueRouter from 'vue-router'
import Index from './Index.vue'
import router from './router'
import http from './http'
import store from './store'
import {ValidationObserver, ValidationProvider} from "vee-validate";
import Vuex from "vuex";
import 'es6-promise/auto'


window.Vue = Vue

Vue.config.productionTip = false;
Vue.use(Vuex);
Vue.use(VueRouter)
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
import config from './config'
Vue.router = router;

const app = new Vue({
    el: '#app',
    router,
    config,
    store,
    components: {Index},
    http
});
