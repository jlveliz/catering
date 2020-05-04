/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import { store } from './store/index';
 

import router from './routes';
import Bootstrap from './components/Bootstrap';


const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Bootstrap),
});

