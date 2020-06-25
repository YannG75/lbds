<template>
    <div>
        <navigation></navigation>
        <div class="container">
            <div class="columns">
                <div class="column is-two-thirds">
                    <h2 class="is-size-2 has-text-grey-dark mt mb ">Panier :</h2>
                    <template v-if="cart.products.length !== 0">
                        <div  class="is-flex product-card" v-for="(item, i) in cart.products" :key="i">
                            <figure class="image is-128x128 is-flex">
                                <img class="" :src="item.product.image" alt="Placeholder image">
                            </figure>
                            <h3 class="title is-6 ">{{item.product.name}}</h3>

                            <b-field>
                                <b-numberinput v-model="cart.products[i].quantity" :editable=false min="1" controls-position="compact"></b-numberinput>
                            </b-field>

                            <b-button type="is-text" @click="delSneaker(i)"><i class="fas fa-times"></i></b-button>
                        </div>
                    </template>

                    <div v-else>
                        <h4 class="is-size-3">Votre panier est vide pour le moment !</h4>
                    </div>
                </div>
                <div class="column dark">
                    <h2 class="is-size-2 mt mb ">details :</h2>
                    <div class="is-flex cart-described">
                        <article class="is-size-4"><b>subtotal :</b> <span>{{subtotal}} €</span></article>
                        <article class="is-size-4"><b>Taxes :</b> <span>Free</span></article>
                        <article class="is-size-4"><b>Total price :</b> <span>{{subtotal}} €</span></article>
                        <router-link to="/order">
                            <b-button v-if="cart.products.length !== 0" type="is-success" class="add" outlined>Valider le panier</b-button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
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
    import navigation from "../../components/Navigation";
    export default {
        name: "basket",
        data() {
            return {
                number: 0,
                cart: {
                    products: []
                },
                subtotal : 0
            }
        },
        components: {
          navigation
        },
        mounted() {
            if (localStorage.cart){
                this.cart = JSON.parse(localStorage.cart)
                this.cart.products.forEach(item => {
                    this.subtotal += item.price*item.quantity
                })
            }

        },

        watch: {
            cart: {
                handler(val, oldVal) {
                    this.$store.state.cart = val
                    this.subtotal = 0
                    val.products.forEach(item => {
                        this.subtotal += item.price*item.quantity
                    })
                    if((oldVal.products.length !== 0) && val !== 0)
                    this.$store.commit('toastSuccess', {msg: 'panier mis à jours avec succès ! 👌'})
                },
                deep: true
            }
        },
        methods: {
            delSneaker(id) {
                this.cart.products.forEach( item => {
                    if (id === this.cart.products.indexOf(item))
                    this.cart.products.splice(this.cart.products.indexOf(item),1)
                })

            }
        }
    }
</script>

<style scoped lang="scss">
    .container {
        background: rgba(255, 250, 250, 0.41);
    }



    .is-flex {
        align-items: center;
        justify-content: center;
    }

    .product-card {
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: #3cd07d solid .5px;

        .field:not(:last-child) {
            margin-bottom: unset;
            width: 120px;
        }

        .title {
            margin-bottom: unset;
        }
    }

    .dark {
        background: #41424a;
        color: aliceblue;
        box-shadow: #1b1e21 1px 1px 6px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 282px;
    }

    .cart-described {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;

        article {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .add {
            margin-top: 20px;
            color: #3cd07d;
            border-color: #3cd07d;

            transition: all ease-in 300ms;

            &:hover {
                background: #3cd07d;
            }
        }


    }

    @media all and (max-width: 600px) {
        .field:not(:last-child) {
            width: 200px !important;
        }
    }
</style>
