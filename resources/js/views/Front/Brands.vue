<template>
    <div>
        <navigation></navigation>
            <div class="container">
                <img class="is-centered" width="100%" :src="brand.banner" alt="brand banner">
            </div>
        <section class="container grid">
            <products v-for="(sneaker, index) in brand.products" :sneaker="sneaker" :key="index"></products>
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
    import navigation from "../../components/Front/Navigation";
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import products from '../../components/Front/AllProducts'
    import axios from "axios";
    export default {
        name: "Brands",
        data() {
            return {
                brand: {}
            }
        },
        components:{
            products,
            navigation
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
