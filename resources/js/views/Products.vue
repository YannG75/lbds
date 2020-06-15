<template>
    <div>
        <h1 class="is-size-2 has-text-centered mt mb">Toutes les Sneakers</h1>
        <section class="container is-flex justify-content-around p-3 brandBar">

            <div class="brandContainer" v-for="(brand, index) in getBrands" :key="index" >
                <router-link :to="/brands/+brand.id">
                    <b-tooltip :label="`${brand.products.length} produit`"
                               position="is-bottom">
                        <img :src="brand.image" :srcset="`${brand.image} 2x`" :alt="`brand.name logo`">
                    </b-tooltip>

                </router-link>
            </div>
        </section>
        <section class="container grid">
            <AllProducts v-for="(sneaker, index) in getProducts" :sneaker="sneaker" :key="index"></AllProducts>
        </section>
    </div>
</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import AllProducts from "../components/AllProducts";

    export default {
        name: "Products",
        components: {
            AllProducts
        },
        computed: {
            ...mapGetters(['getProducts', 'getBrands'])
        },
        mounted() {
            this.GetAllProducts()
            this.GetAllBrands()
        },
        methods: {
            ...mapActions(['GetAllProducts', 'GetAllBrands'])
        }
    }
</script>

<style scoped lang="scss">

    .brandBar {
        border-radius: 5px;
        box-shadow: #00d1b2 1px 1px 7px -2px;
    }

    .justify-content-around {
        justify-content: space-around;
    }



    .brandContainer {
        width: 90px;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;


        img {
            width: 100%;
            object-fit: cover;
        }
    }
</style>
