<template>
    <div>
        <navigation></navigation>
        <caroussel :getLastNews="getLastNews"></caroussel>

        <section class="gridCenter">
            <router-link :to="{ path: '/products' }">
                <div class="is-relative category" id="sneakers">
                    <h4 class="is-absolute absolute-top">Sneakers</h4>
                </div>
            </router-link>
            <router-link :to="{ path: '/news' }">
                <div class="is-relative category" id="news">
                    <h4 class="is-absolute absolute-top">News</h4>
                </div>
            </router-link>
        </section>

        <section id="random" class="pb-5">
            <div class="p-3"><h2 class="has-text-white-bis is-size-2 ">Sneakers au hasard</h2></div>

            <div class="container">
                <b-carousel-list :data="getRandomProducts" :items-to-show="3" :repeat="true">

                    <template slot="item" slot-scope="props">
                        <router-link :to="/products/+props.list.id">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-5by4">
                                        <a @click=""><img :src="props.list.image"></a>
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <h3 class="title is-6">{{ props.list.name }}</h3>
                                        <p class="subtitle is-7 ellipsis">{{ props.list.description }}</p>
                                        <div class="field is-grouped">
                                            <article class="control" style="margin-left: auto">
                                                <button class="is-flex has-background-white">
                                                    <div class="  ">{{ props.list.price }} €</div>
                                                </button>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </template>


                </b-carousel-list>
            </div>

        </section>
        <footer class="footer mt">
            <div class="content has-text-centered ">
                <p>
                    <strong>LBDS</strong> by <em>Yann Grillon</em>. The source code is licensed.
                    The website content is licensed.
                    <br>
                    © Copyright
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import caroussel from "../../components/Front/caroussel"
    import navigation from "../../components/Front/Navigation";


    export default {
        name: "Home",
        components: {
            caroussel,
            navigation

        },
        data() {
            return {
                openSearch: false
            }
        },
        computed: {
            ...mapGetters(['getLastNews', 'getRandomProducts'])
        },
        mounted() {
            this.GetLastNews()
            this.GetRandomProducts()
        },
        methods: {
            ...mapActions(['GetLastNews', 'GetRandomProducts'])


        }
    }
</script>


<style lang="scss">
    .hero {
        background-size: cover !important;
    }

    .hero-body {
        height: 36rem;
        padding: 20px !important;
        display: flex;
        align-items: flex-end;

        section {
            width: 100%;
            padding: 10px 10px 35px 10px;

            h1, p {
                color: #65f9c4;
                text-shadow: black 1px 1px 4px;
            }

            .check-it {
                display: flex;
                justify-content: center;

                article {
                    border-radius: 1px;
                    cursor: pointer;
                    padding: 10px 15px;
                    height: fit-content;
                    text-shadow: aliceblue 1px 1px 1px;
                    background: aliceblue;
                    font-size: 20px;
                    font-weight: bold;
                    box-shadow: #1b1e21 1px 1px 7px;

                    i {
                        color: #00d1b2;
                    }
                }

                article:hover {
                    background: #1b1e21;
                    text-shadow: black 1px 1px 1px;
                    color: #00d1b2;
                }
            }
        }

    }

    .level-item {
        padding-right: 30px;
        transition:  padding-right .5s;
        .fa-search {
            position: absolute;
            cursor: pointer;
            left: 5px;
            opacity: 0.2;

        }

        input {
            padding-left: 0;
            width: 0;
            border: none;
            outline: none;
            margin-right: 15px;
            transition: width .5s ease-in, padding-left .5s;
        }

        .open {
            border-bottom: #00d1b2 1px solid;
            width: 150px;
            padding-left: 22px;
        }

        .btn-basket {
            justify-content: space-between;
            cursor: pointer;
            background: #fafafa;
            padding: 5px;
            margin-right: 10px;

            .fa-shopping-cart {
                color: #00d1b2;
                display: flex;
                align-items: center;
                margin-right: 5px;
            }

            .basket-items {
                color: #00d1b2;
            }
        }

        .btn-basket:hover {
            background: #00d1b2;

            .fa-shopping-cart {
                color: #fafafa;
            }

            .basket-items {
                color: #fafafa;
            }
        }
    }

    .opened {
        padding-right: unset;
    }

    section.gridCenter {
        background: #fcfcfa;

        .category {
            width: 270px;
            height: 150px;
            cursor: pointer;
            box-shadow: #a1a9b0 1px 1px 4px;
            transition: all .2s ease-in-out;
        }

        .category:hover {
            transform: scale(1.1);
        }

        #news {
            background: url("/images/logo-konbini.jpg") no-repeat center;
            background-size: cover;
        }

        #sneakers {
            background: url("/images/sneakers-basket-homme-et-femme-montante-de-mode.jpg") no-repeat center;
            background-size: cover;
        }
    }

    section#random {
        background: #242328;

        .carousel-arrow .icon {
            background: #202020;
            color: #3cd07d;
        }

        button {
            border: none;
            cursor: pointer;

            div {

                justify-content: center;
                padding: calc(0.385em - 1px) 0.80em;

                text-align: center;
                white-space: nowrap;
                font-size: 1rem;
                height: 2.25em;
                line-height: 1.5;
            }


            .money {
                border-right: unset;
            }

        }
    }

</style>
