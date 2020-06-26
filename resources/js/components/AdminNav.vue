<template>
    <b-navbar>
        <template slot="brand">
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                <img src="/images/logo_admin.png"/>
            </b-navbar-item>
        </template>
        <template slot="start">
        </template>

        <template slot="end">
            <b-dropdown v-if="authenticated"
                        v-model="navigation"
                        position="is-bottom-left"
                        append-to-body
                        has-link
                        aria-role="menu">
                <a
                    class="navbar-item"
                    slot="trigger"
                    role="button">
                    <span>Menu</span>
                    <b-icon icon="menu-down"></b-icon>
                </a>

                <b-dropdown-item custom aria-role="menuitem">
                    Connecté en tant que <b>{{user.name}}</b>
                </b-dropdown-item>
                <hr class="dropdown-divider">
                <b-dropdown-item value="admin" aria-role="menuitem">
                    <router-link :to="{ name: 'admin' }">
                    <b-icon icon="home"></b-icon>
                    Home
                    </router-link>
                </b-dropdown-item>
                <b-dropdown-item value="adminBrands" aria-role="menuitem" >
                    <router-link :to="{ name: 'adminBrands' }">
                    <b-icon icon="tags"></b-icon>
                    Marques
                    </router-link>
                </b-dropdown-item>
                <b-dropdown-item value="adminProducts" aria-role="menuitem">
                    <router-link :to="{ name: 'adminProducts' }">
                    <b-icon icon="shopping-cart"></b-icon>
                    Produits
                    </router-link>
                </b-dropdown-item>
                <b-dropdown-item value="adminNews" aria-role="menuitem" >
                    <router-link :to="{ name: 'adminNews' }">
                    <b-icon icon="book-open"></b-icon>
                    News
                    </router-link>
                </b-dropdown-item>
                <hr class="dropdown-divider" aria-role="menuitem">
                <!--                <b-dropdown-item value="settings">-->
                <!--                    <b-icon icon="settings"></b-icon>-->
                <!--                    Settings-->
                <!--                </b-dropdown-item>-->
                <b-dropdown-item value="logout" aria-role="menuitem" @click="signOut">
                    <b-icon icon="power-off" class="has-text-danger"></b-icon>
                    Déconnexion
                </b-dropdown-item>
            </b-dropdown>
        </template>
    </b-navbar>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "AdminNav",
        data() {
            return {
                navigation: this.$route.name
            }
        },
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user',
            })
        },
        methods: {
            ...mapActions({
                signOutAction: 'auth/signOut'
            }),

            async signOut () {
                await this.signOutAction()

                await this.$router.replace({name: 'admin'})
            }
        }
    }
</script>

<style scoped lang="scss">
    .navbar-item img {
        max-height: unset;
        height: 60px;
    }

    .navbar-burger {
        margin-top: auto;
        margin-bottom: auto;
    }

    .navbar {
        background: #2f2f2f;
        box-shadow: #424242 1px 1px 15px;
    }

    .navbar-item, .navbar-link {
        color: #3dd481;
    }

    a.navbar-item:focus, .navbar-item:hover, .navbar-item a:hover, .navbar-item a:focus {
        color: #3ee28d !important;
        background: #4d4d4d;
    }

    a {
        color: unset;
        .is-active {
            color: white!important;
        }

        .dropdown-item {
            color: #3273dc;
        }
    }

</style>
