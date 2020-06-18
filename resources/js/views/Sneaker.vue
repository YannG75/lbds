<template>
    <div class="container">
        <section class="columns mt">
            <b-carousel class="column" :indicator-inside="false" :autoplay="false" :indicator-custom="true"
                        :indicator-custom-size="`is-medium`" :key="$route.path">
                <b-carousel-item v-for="(item, i) in sneaker.images" :key="i">
                    <figure class="image">
                        <img :src="item.image">
                    </figure>
                </b-carousel-item>
                <template slot="indicators" slot-scope="props">
            <span class="al image">
                <img :src="getUrl(props.i)" :title="props.i">
            </span>
                </template>
            </b-carousel>
            <article class="column">
                <h2 class="is-size-1 mb">{{sneaker.name}}</h2>
                <h3 class="is-size-2 has-text-primary mt mb">{{ sneaker.price }} €</h3>

                <p class="mb">{{sneaker.description}}</p>
                <span class="mt">Choisissez une taille :</span>
                <form action="">
                    <section class="gridSize ">
                        <div v-for="(size, i) in sizes" class="is-relative">
                            <input type="radio" class="" v-model="taille" :disabled="size.disabled" :value="size.size"
                                   :id="i">
                            <label :for="i" :class="{'is-disabled': size.disabled}">{{size.size}}</label>
                        </div>
                    </section>
                    <div class="is-flex">
                        <button class="button is-primary is-outlined m-auto add" type="submit" @click.prevent="addToCart">
                            Ajoutez au panier !
                        </button>
                    </div>
                </form>
            </article>
        </section>

    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState, mapMutations} from 'vuex'
    import sizes from '../../../database/data/sizes'
    import axios from "axios";

    export default {
        name: "sneaker",
        data() {
            return {
                sneaker: {},
                taille: undefined,
                form: {},
                sizes
            }
        },
        computed: {},
        mounted() {
            axios.get('/api/products/' + this.$route.params.id)
                .then(res => {
                    this.sneaker = res.data
                })
        },
        methods: {
            getUrl(index) {
                return this.sneaker.images[index].image
            },

            addToCart(){
                if(this.taille === undefined )
                    this.$store.commit('toastFail', {msg : 'oups il faut choisir une taille 😅'})
                else
                this.$store.commit('addToCart',{id: this.sneaker.id,product : this.sneaker, size: this.taille, quantity: 1, price: this.sneaker.price})
            }
        }
    }
</script>

<style scoped lang="scss">
    .column {
        padding: 1.75rem;
    }

    label {
        padding: .5rem 1.25rem;
        border-radius: 5px;
        cursor: pointer;
        color: #444;
        transition: color 400ms ease;

        &:hover {
            color: #41ffa7;

        }

        &.is-disabled:hover {
            color: lightgray;
        }

    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked + label {

        color: #3dd481;

    }

    .is-disabled {
        color: lightgray;
    }

    .button {
        border-radius: 4px;
    }
    .add {
        color: #3cd07d;
        transition: all ease-in 300ms;
    }

    .add:hover {
        background-color: #151515;
    }
</style>
