<template>
    <div>
        <h1 class="is-size-2 has-text-centered mt mb">Les dernières SneakNews</h1>

        <section class="container grid">
            <div class="card is-shadowless is-pointed" v-for="(news, index) in getNews" :key="index">
                <router-link :to="/news/+news.id">
                    <div class="Hovered is-absolute">
                        <button class="button is-primary">Check it</button>
                    </div>
                </router-link>
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img :src="news.image" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-6 ">{{ news.title}}</p>
                        </div>
                    </div>
                    <time class="has-text-grey-light">{{$moment(news.created_at).locale('Fr').format('LL')}}</time>
                </div>

            </div>
        </section>

    </div>

</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'

    export default {
        name: "News",
        computed: {
            ...mapGetters(['getNews'])
        },
        mounted() {
            this.GetAllNews()
        },
        methods: {
            ...mapActions(['GetAllNews'])
        }
    }
</script>

<style scoped lang="scss">
    .grid {
        grid-template-columns: repeat(auto-fill, 240px);
    }

    img {
        object-fit: cover;
    }

</style>
