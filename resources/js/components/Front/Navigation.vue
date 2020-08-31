<template>
    <b-navbar :shadow="true" class="global">
        <template slot="brand" class="brandos">
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                <img src="/images/logo.png"/>
            </b-navbar-item>
            <section class="level-item mobile">
                <router-link to="/basket">
                    <div class="btn-basket is-flex">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="basket-items"><span>{{cart.products.length}} {{cart.products.length >1 ? 'items': 'item'}}</span>
                        </div>
                    </div>
                </router-link>

                <div class="level-item is-relative" :class="{'opened': openSearch}">
                    <i class="fas fa-search" @click="openSearch = !openSearch"></i>
                    <input type="search" v-model="search" :class="{'open': openSearch}"
                           @keypress.enter="goToSearchRoute">

                </div>
            </section>


        </template>
        <template slot="start">
            <b-navbar-item tag="router-link" :to="{ path: '/products' }">
                Catalogue
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ path: '/news' }">
                News
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{ path: '/contact' }">
                Contactez-nous
            </b-navbar-item>
        </template>

        <template slot="end">

            <section class="level-item desktop">
                <router-link to="/basket">
                    <div class="btn-basket is-flex">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="basket-items"><span>{{cart.products.length}} {{cart.products.length >1 ? 'items': 'item'}}</span>
                        </div>
                    </div>
                </router-link>

                <div class="level-item is-relative" :class="{'opened': openSearch}">
                    <i class="fas fa-search" @click="openSearch = !openSearch"></i>
                    <input type="search" v-model="search" :class="{'open': openSearch}"
                           @keypress.enter="goToSearchRoute">

                </div>
            </section>




        </template>
    </b-navbar>
</template>

<script>
    import {mapGetters, mapActions, mapState, mapMutations} from 'vuex'

    export default {
        name: "navigation",
        data() {
            return {
                openSearch: false,
                search: '',
            }
        },

        computed: {
            ...mapState(['cart'])
        },

        mounted() {
            if (localStorage.cart)
                this.$store.state.cart = JSON.parse(localStorage.getItem('cart'))
        },


        watch: {
            cart: {
                handler: function (val, oldVal) {
                    if (localStorage.getItem('cart') !== val)
                        localStorage.setItem('cart', JSON.stringify(val))
                    if (JSON.parse(localStorage.getItem('cart')).products.length === 0)
                        localStorage.removeItem('cart')
                },
                deep: true
            }

        },
        methods: {
            goToSearchRoute() {
                this.$router.replace('/search/' + this.search)
                this.search = ''
                this.openSearch = false
            }
        }

    }
</script>

<style scoped lang="scss">
    .navbar-item img {
        max-height: unset;
        height: 60px;
    }

    .mobile {
        display: none;
        margin-left: auto;
        margin-bottom: unset;
    }

    .global {
        position: sticky;
        top:0;
    }



    a.navbar-item:focus, .navbar-item:hover, .navbar-item a:hover, .navbar-item a:focus {
        color: #3cd07d !important;
    }

    .navbar-link::after {
        border-color: #3cd07d !important;
    }

    @media all and (max-width: 1023px){
        .mobile {
            display: flex;
        }
        .desktop {
            display: none;
        }


    }

@media all and (max-width: 425px){
        .mobile {
            display: block;
        }
        .btn-basket {
            margin-bottom: 5px;
            width: fit-content;
        }



    }



</style>
