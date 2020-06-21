<template>
    <div class="container">
        <h1 class="is-size-3 has-text-centered mb">
            On reprend !
        </h1>
        <div class="columns">
            <article class="column is-two-thirds left">
                <h2 class="title">
                    Tes infos :
                </h2>
                <div class="card">

                    <div class="card-content ">
                        <h3 class="is-size-4 has-text-grey-light is-italic has-text-centered mt mb">Personnelles</h3>

                        <h4 class="is-size-5 has-text-weight-medium">Nom</h4>
                        <p class="">
                            {{form.lastname}}
                        </p>
                        <h4 class="is-size-5 has-text-weight-medium">Prénom</h4>
                        <p class="">
                            {{form.firstname}}
                        </p>
                        <h4 class="is-size-5 has-text-weight-medium">Email</h4>
                        <p class="">
                            {{form.email}}
                        </p>
                        <h4 class="is-size-5 has-text-weight-medium">Adresse</h4>
                        <p class="">
                            {{form.address}}
                        </p>

                        <h3 class="is-size-4 has-text-grey-light is-italic has-text-centered mt mb">Bancaires</h3>
                        <h4 class="is-size-5 has-text-weight-medium">titulaire de la carte</h4>
                        <p class="">
                            {{payment.cardName}}
                        </p>
                        <h4 class="is-size-5 has-text-weight-medium">Numero de carte</h4>
                        <div class="is-flex">
                            <span class="mr-2">Se terminant par </span>
                            <span v-for="(n, $index) in payment.cardNumber" :key="$index">
                            <p v-if="$index > 13">
                             {{payment.cardNumber[$index]}}
                        </p>
                        </span>
                        </div>


                        <h4 class="is-size-5 has-text-weight-medium">Date d'expiration</h4>
                        <p class="">
                            {{payment.cardMonth}}/{{payment.cardYear}}
                        </p>

                    </div>
                </div>
            </article>
            <article class="column right">
                <div class="card">
                        <div class="card-content">
                            <h4 class="is-size-5 has-text-weight-medium">Produits achetés :</h4>
                            <div id="top" class="columns"  v-for="(item, i) in cart.products">
                                <div class="column is-four-fifths">
                                    <div><b>{{item.product.name}}</b></div>
                                    <div>taille : {{item.size}} </div>
                                    <div>Prix : {{item.product.price}} €</div>
                                    <div>Couleur : {{item.product.color}}</div>
                                </div>
                                <div class="column has-text-right">
                                     <span>x{{item.quantity}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="is-flex between mb"><h4 class="is-size-5 has-text-weight-medium">total (TTC) :</h4> <span>{{total}} €</span></div>
                            <div class="is-flex between mb"><h4 class="is-size-5 has-text-weight-medium">code promo :</h4> <input type="text" placehorlder="aucun code" disabled=""></div>


                        </div>
                </div>
            </article>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Recap",
        data() {
            return {
                total : 0
            }
        },
        props: {
            form : Object,
            payment: Object,
            cart: Object
        },

        beforeMount() {

            this.cart.products.forEach(item => {
                this.total += item.product.price*item.quantity
            })
        }
    }
</script>

<style scoped lang="scss">


    p {
        margin-bottom: 5px;
    }

    .card {
        border-radius: 5px;
        .card-content {

        }
    }

    #top {
        padding: 10px;
        border-bottom: 1px solid rgba(61, 212, 129, 0.42);
    }

    .left {
        .card {

        }
    }

    .right {
        .card {
            margin-top: 60px;

        }
    }


</style>
