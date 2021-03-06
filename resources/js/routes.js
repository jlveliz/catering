import Vue from 'vue';
import VueRouter from 'vue-router';
import { store } from './store'
Vue.use(VueRouter);


// Components
import LoginViewComponent from './components/login/login';
import HomeViewComponent from './components/dashboard/home';
import SettingIndex from './components/settings/setting/index'
import WorkplaceIndex from './components/settings/workplace/index';
import AccountingIndex from './components/settings/accounting/index';
import UsersIndex from './components/settings/user/index';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginViewComponent,
            beforeEnter: (to, from, next) => {
                if (store.getters.loggedIn) {
                    next({ name: 'home' });
                } else {
                    next();
                }
            }
        },
        {
            path: '/home',
            name: 'home',
            component: HomeViewComponent,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/users',
            name: 'users',
            component: UsersIndex,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/accounting',
            name: 'accounting',
            component: AccountingIndex,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/workplaces',
            name: 'workplaces',
            component: WorkplaceIndex,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/settings',
            name: 'settings',
            component: SettingIndex,
            meta: {
                requiresAuth: true
            }
        }
    ]
})

export default router;
