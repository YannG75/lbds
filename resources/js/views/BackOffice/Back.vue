<template>
    <div>
        <h1 class="has-text-grey-light has-text-centered is-size-1 mt mb">Back Office</h1>
        <div class="container pt">
            <div class="card mt" v-if="!authenticated">
                <div class="card-content has-text-centered">
                    <p class="title">
                        Bienvenue dans le Back Office ! La gestion des articles, produits et marques ce fait ici, une
                        fois authentifié 👦
                    </p>
                    <div class="is-flex center">
                        <router-link to="/admin/login">
                            <b-button type="is-dark" outlined class="green is-center">Je m'identifie</b-button>
                        </router-link>
                    </div>

                </div>
            </div>
            <div class="columns" v-else>
                <div class="column ">
                    <img src="/images/undraw_server_push_vtms.svg" alt="BackOffice illustration" width="100%">
                </div>
                <div class="column grid ">
                    <router-link :to="{ name: 'adminBrands' }" class="grow">
                    <div class="card brand is-flex">
                        <h4 class="is-primary is-size-2">Marques</h4>
                    </div>
                    </router-link>
                    <router-link :to="{ name: 'adminProducts' }" class="grow" >
                    <div class="card products is-flex">
                        <h4 class="is-primary is-size-2">Produits</h4>
                    </div>
                    </router-link>
                    <router-link :to="{ name: 'adminNews' }" class="grow">
                    <div class="card news is-flex">
                        <h4 class="is-primary is-size-2">News</h4>
                    </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "back",
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated'
            })
        },
    }
</script>

<style scoped lang="scss">
    .grid {
        grid-auto-rows: minmax(100px, 206px);

    }

        .is-flex {
            justify-content: center;
            h4 {
                text-shadow: white 1px 1px 7px;
            }
        }

        .grow {
            transition: all ease .3s;
        }
        .grow:hover {
            transform: scale(1.2);
            box-shadow: 1px 1px 7px black;
        }


    .brand {
        width: 100%;
        height: 100%;
        background: url("/images/undraw_logo_design_bjnx.svg") no-repeat center;
        background-size: contain;

    }

    .products {
        width: 100%;
        height: 100%;
        background: url("/images/undraw_shopping_app_flsj.svg") no-repeat center;
        background-size: contain;
    }

    .news {
        width: 100%;
        height: 100%;
        background: url("/images/undraw_post2_19cj.svg") no-repeat center;
        background-size: contain;
    }

</style>
