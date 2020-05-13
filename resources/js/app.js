/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Main Js
require('./bootstrap');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueFeather from 'vue-feather';
import { store } from './store';
import router from './routes';


// Main Css
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import './../css/app.css';
import '../sass/app.scss'

//Configure Plugins
// Vue.use(VueAxios, axiosInstance);
Vue.use(BootstrapVue);
Vue.use(VueFeather);
Vue.use(IconsPlugin);


//Call App
import Bootstrap from './components/Bootstrap';


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.loggedIn) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})


const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Bootstrap),
});

