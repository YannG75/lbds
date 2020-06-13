<template>
    <div>
            <div class="container">
                <img class="is-centered" width="100%" :src="brand.banner" alt="brand banner">
            </div>
        <section class="container grid">
            <products v-for="(sneaker, index) in brand.products" :sneaker="sneaker" :key="index"></products>
        </section>
    </div>
</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import products from '../components/AllProducts'
    import axios from "axios";
    export default {
        name: "Brands",
        data() {
            return {
                brand: {}
            }
        },
        components:{
            products
        },
        computed: {

        },
        mounted() {
            axios.get('/api/brands/'+this.$route.params.id)
                .then(res => {
                    this.brand = res.data
                })
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
