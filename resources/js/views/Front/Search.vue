<template :key="change">
    <div>
        <navigation></navigation>
        <div class="container pb" >
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
    import navigation from "../../components/Front/Navigation";
    import AllProducts from "../../components/Front/AllProducts";


    export default {
        name: "Search",
        data() {
            return {
                search: this.$route.params.search,
            }
        },
        components:{
            AllProducts,
            navigation
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
