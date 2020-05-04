import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


// Components
import LoginViewComponent from './components/login/login';

const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/',
            name:'login',
            component:LoginViewComponent,

        },
    ]
})

export default router;
