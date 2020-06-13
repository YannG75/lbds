<template>
    <b-carousel :indicator-style="`is-boxes`" >
        <b-carousel-item  v-for="(news, i) in getLastNews" :key="i">
            <section :class="`hero is-large`">
                <div class="hero-body is-5by3">
                    <figure class="image is-5by3 is-absolute l-0 t-0">
                        <img :src="news.banner" alt="news banner">
                    </figure>
                    <section class="is-flex index">
                        <div class="column">
                            <h1 class="title">{{news.title}}</h1>
                            <p class="has-text-white-ter has-shadow"> {{ news.summary}}</p>
                        </div>

                        <div class="column is-flex check-it">
                            <router-link :to="/news/+news.id">
                            <article class="">
                                <i class="fas fa-long-arrow-alt-right "></i>
                            </article>
                            </router-link>
                        </div>

                    </section>

                </div>
            </section>
        </b-carousel-item>
    </b-carousel>
</template>

<script>
    export default {
        name: "caroussel",
        props: {
            getLastNews : Array
        }
    }
</script>

<style scoped lang="scss">
.carousel-item {
    transition-timing-function: ease-in-out;
    transition-duration: 1.3s;
}

    figure {
        width: 100%;
    }
    .hero-body {
        width: 100%;
        height: 80vh;
    }
</style>
