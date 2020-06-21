
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import Buefy from 'buefy'
import moment from 'moment'
import Vuelidate from 'vuelidate'
import VueMask from 'v-mask'
Vue.use(VueMask);

Vue.prototype.$moment = moment

Vue.use(Buefy,{
    defaultIconPack: 'fas',
})
Vue.use(Vuelidate)
Vue.use(VueRouter)
import  Home from './views/Home'
import App from './views/App'
import Brand from "./views/Brands";
import News from "./views/News";
import Products from "./views/Products";
import Search from "./views/Search";
import Sneaker from "./views/Sneaker";
import Article from "./views/Article";
import Basket from "./views/Basket";
import Contact from "./views/Contact";
import Order from "./views/Order";


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


    ],
});

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
});
