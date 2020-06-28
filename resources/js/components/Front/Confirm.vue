<template>
    <div class="container">
        <h1 class="has-text-centered is-size-2 mb mt ">Ta commande est passé ! On te livre ça bientôt !</h1>
        <div class="is-flex is-centered">
            <img src="https://media.giphy.com/media/d5pGYhWb3T1Hyyl8OB/source.gif" alt="">
        </div>

        <div class="is-flex is-centered">
            <router-link to="/">
                <button class="button is-primary is-outlined m-auto add" >
                    Retour a l'accueil
                </button>
            </router-link>
        </div>


    </div>
</template>

<script>
    export default {
        name: "confirm"
    }
</script>

<style scoped lang="scss">
    .is-centered {
        justify-content: center;
        margin-bottom: 20px;
    }

</style>
