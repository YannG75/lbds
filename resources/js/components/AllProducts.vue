<template>

        <div class="card is-pointed is-shadowless">
            <router-link :to="/products/+sneaker.id">
            <div class="Hovered is-absolute">
                    <button class="button is-primary">Check it</button>
            </div>
            </router-link>
            <div class="card-image">
                <figure class="image is-4by3">
                    <img :src="sneaker.image" alt="Placeholder image">
                </figure>
            </div>
            <div class="card-content">
                <div class="media">
                    <div class="media-content">
                        <p class="title is-6 ">{{ sneaker.name}}</p>
                    </div>
                </div>

                <div class="content ellipsis has-text-grey-light">
                    {{ sneaker.description}}
                </div>
                <h4 class="has-text-right">{{ sneaker.price }} €</h4>
            </div>
        </div>
</template>

<script>
    export default {
        name: "AllProducts",
        props: {
            sneaker: Object
        }
    }
</script>

<style scoped lang="scss">

</style>
