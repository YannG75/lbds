<template>

    <div class="container">
        <div class="card">
            <div class="card-content login">
                <p class="title ">
                    On veut mieux te connaitre
                </p>
                <p class="subtitle">
                    Avec ton adresse on pourra t'envoyer tes achats !
                </p>
                <div class="field" :class="{ 'error': v.form.lastname.$error }">
                    <label class=" label">Nom</label>
                    <div class="control">
                        <input v-model.trim="v.form.lastname.$model" class="input" type="text" placeholder="LeBron" >
                    </div>
                    <div class="" v-if="v.form.lastname.$error">Champ requis !</div>
                </div>
                <div class="field" :class="{ 'error': v.form.firstname.$error }">
                    <label class="label">Prenom</label>
                    <div class="control">
                        <input v-model.trim="v.form.firstname.$model" class="input" type="text" placeholder="James" >
                    </div>
                    <div class="" v-if="v.form.firstname.$error">Champ requis !</div>
                </div>
                <div class="field" :class="{ 'error': v.form.email.$error }">
                    <label class="label">Email</label>
                    <div class="control">
                        <input v-model.trim="v.form.email.$model" class="input" type="email" placeholder="AirJordans@hotmail.fr">
                    </div>
                    <div class="" v-if="v.form.email.$error">Champ requis et doit être au format email !</div>
                </div>
                <div class="field" :class="{ 'error': v.form.address.$error }">
                    <label class="label">Adresse</label>
                    <div class="control">
                        <input v-model.trim="v.form.address.$model" class="input" type="email"
                               placeholder="11 rue de la chaussure 75014 Paris">
                    </div>
                    <div class="" v-if="v.form.address.$error">Champ requis !</div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        name: "Personal",
        data() {
            return {}
        },
        props: {
            form: Object,
            error: Boolean,
            v: Object
        },

        methods: {
            test() {
                console.log(this.v.form.firstname)
            }
        }

    }
</script>

<style lang="scss" lang="scss">
    .field {

        input {
            box-shadow: unset;
        }

    }

    .card {
        max-width: 900px;
        margin: auto;
    }
</style>
