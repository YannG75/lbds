<template>
    <div>
        <navigation></navigation>
        <div class="container">
            <section v-if="article !== null">
                <h1 class="is-size-1 has-text-primary mt mb p-1">{{ article.title }}</h1>
                <h3 class="is-size-4 has-text-grey-light mt mb p-1">{{ article.summary }}</h3>
                <span class="has-text-grey-light p-2">{{$moment(article.created_at).locale('Fr').fromNow()}}</span>
                <figure class="mt mb">
                    <img :src="article.banner" alt="banner">
                </figure>
                <div class="p-2">
                    <p class="mb">{{ article.content }}</p>
                </div>

                <figure class="">
                    <img class=" mb mt" :src="article.image" alt="">
                </figure>

            </section>

            <b-message v-else type="is-danger" has-icon class="mt mb ">
                Ce produit n'existe pas !
            </b-message>

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
    import axios from "axios";
    import navigation from "../../components/Front/Navigation";

    export default {
        name: "Article",
        data() {
            return {
                article: {}
            }
        },
        components: {
            navigation
        },
        mounted() {
            axios.get('/api/news/' + this.$route.params.id)
                .then(res => {
                    this.article = res.data
                })
            .catch(err => {
                this.article = null
            })
        },
        methods: {}
    }
</script>

<style scoped lang="scss">

    figure {
        width: fit-content;
        margin: auto;
    }

</style>
