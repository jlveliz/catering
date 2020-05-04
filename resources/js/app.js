/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Main Js
require('./bootstrap');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import { store } from './store/index';


// Main Css
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import './../css/app.css';

//Main Settings
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);


//Call App
import router from './routes';
import Bootstrap from './components/Bootstrap';




const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Bootstrap),
});

