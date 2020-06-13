<template>
    <div class="container">
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

    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "Article",
        data() {
            return {
                article: {}
            }
        },
        mounted() {
            axios.get('/api/news/' + this.$route.params.id)
                .then(res => {
                    this.article = res.data
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
