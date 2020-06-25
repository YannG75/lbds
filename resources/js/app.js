/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Login from "./views/BackOffice/Login";

require('./bootstrap');
import axios from 'axios'
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import Buefy from 'buefy'
import moment from 'moment'
import Vuelidate from 'vuelidate'
import VueMask from 'v-mask'

Vue.use(VueMask);

Vue.prototype.$moment = moment

axios.defaults.withCredentials = true

Vue.use(Buefy, {
    defaultIconPack: 'fas',
})
Vue.use(Vuelidate)
Vue.use(VueRouter)
import Home from './views/Front/Home'
import App from './views/Front/App'
import Brand from "./views/Front/Brands";
import News from "./views/Front/News";
import Products from "./views/Front/Products";
import Search from "./views/Front/Search";
import Sneaker from "./views/Front/Sneaker";
import Article from "./views/Front/Article";
import Basket from "./views/Front/Basket";
import Contact from "./views/Front/Contact";
import Order from "./views/Front/Order";
import Index from "./views/BackOffice/Index";
import Back from "./views/BackOffice/Back";
import BackBrand from "./views/BackOffice/BackBrand";
import BackProducts from "./views/BackOffice/BackProducts";
import BackNews from "./views/BackOffice/BackNews";


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/brands/:id',
            name: 'brands',
            component: Brand
        },

        {
            path: '/news',
            name: 'news',
            component: News
        },

        {
            path: '/news/:id',
            name: 'article',
            component: Article
        },

        {
            path: '/products',
            name: 'products',
            component: Products
        },

        {
            path: '/search/:search',
            name: 'search',
            component: Search
        },

        {
            path: '/products/:id',
            name: 'sneacker',
            component: Sneaker
        },

        {
            path: '/basket',
            name: 'basket',
            component: Basket
        },

        {
            path: '/contact',
            name: 'contact',
            component: Contact
        },

        {
            path: '/order',
            name: 'order',
            component: Order
        },

        {
            path: '/admin',
            component: Index,
            children: [
                {
                    path: "",
                    name: "admin",
                    component: Back,
                    meta: {admin: true}

                },

                {
                    path: 'login',
                    name: 'login',
                    component: Login,
                    meta: {admin: true}
                },

                {
                    path: 'brands',
                    name: 'adminBrands',
                    component: BackBrand,
                    meta: {requiresAuth: true, admin: true}

                },

                {
                    path: 'products',
                    name: 'adminProducts',
                    component: BackProducts,
                    meta: {requiresAuth: true, admin: true}

                },

                {
                    path: 'news',
                    name: 'adminNews',
                    component: BackNews,
                    meta: {requiresAuth: true, admin: true}

                },


            ]
        },


    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.admin)) {
        let Auth = store.getters['auth/authenticated']
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (!Auth) {
                next({
                    path: '/admin/login',
                })
            } else {
                next()
            }
        } else if (to.path === '/admin/login' && Auth) {
            next({
                path: '/admin',
            }) // make sure to always call next()!
        } else
            next()
    }

    else
        next()

})
store.dispatch('auth/me').then(() => {
    const app = new Vue({
        el: '#app',
        store,
        components: {App},
        router,
    });
})
