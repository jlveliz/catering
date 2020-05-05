import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


// Components
import LoginViewComponent from './components/login/login';
import HomeViewComponent from './components/dashboard/home';

const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/',
            name:'login',
            component:LoginViewComponent,
        },
        {
            path:'/home',
            name:'home',
            component:HomeViewComponent
        }
    ]
})

export default router;
