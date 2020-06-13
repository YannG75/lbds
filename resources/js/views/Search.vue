<template :key="change">
    <div class="container" >
        <h1 class="is-size-2 has-text-centered mt mb">Resultats pour "{{search}}"</h1>

            <section class="grid">
                <AllProducts v-for="(sneaker, index) in getSearchResult.data" :sneaker="sneaker" :key="index"></AllProducts>
            </section>

            <b-pagination
                :total=getSearchResult.total
                :current.sync=getSearchResult.current_page
                :per-page=getSearchResult.per_page
                :order="`is-centered`"
                aria-next-label="Next page"
                aria-previous-label="Previous page"
                aria-page-label="Page"
                aria-current-label="Current page"
                @change="pageChange">

            </b-pagination>
    </div>

</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import AllProducts from "../components/AllProducts";


    export default {
        name: "Search",
        data() {
            return {
                search: this.$route.params.search,
            }
        },
        components:{
            AllProducts: AllProducts
        },

        computed: {
            ...mapGetters(['getSearchResult'])
        },
        mounted() {
            this.GetSearchResult(this.search)
        },
        methods: {
            ...mapActions(['GetSearchResult','GetResult']),

            pageChange (page) {

                this.GetResult(page)
                window.scrollTo(0,0)
            }
        }
    }
</script>

<style lang="scss">
    .pagination-link.is-current {
        background-color: #00d1b2;
        border-color: #00d1b2;
        color: #fff;
    }
</style>
