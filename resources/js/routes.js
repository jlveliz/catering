import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


// Components
import Dashboard from './components/dashboard/home';

const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/',
            name:'app',
            component:Dashboard,

        },
    ]
})

export default router;
