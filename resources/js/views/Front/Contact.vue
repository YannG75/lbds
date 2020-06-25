<template>
    <div>
        <navigation></navigation>
        <div class="container pb">
            <h1 class="is-size-2 has-text-primary mb mt has-text-centered">Contact</h1>
            <div class="columns mt mb pb pt">
                <article class="column mr-3 p-3">
                    <form action="" class="is-relative">
                        <h2 class="is-size-4 has-text-grey-dark mb mt has-text-centered">Dites-nous tout !</h2>
                        <div class="is-flex">
                            <b-field label="Nom">
                                <b-input v-model="form.nom" placeholder="Kent"></b-input>
                            </b-field>
                            <b-field label="Prenom">
                                <b-input v-model="form.prenom" placeholder="Clark"></b-input>
                            </b-field>
                        </div>

                        <b-field label="Email"

                        >
                            <b-input
                                placeholder="superman@smallville.com"
                                type="email"
                                maxlength="70"
                                v-model="form.email">
                            </b-input>
                        </b-field>

                        <b-field label="Sujet">
                            <b-input v-model="form.sujet" placeholder="ma paire est trop smooth que faire ?"></b-input>
                        </b-field>

                        <b-field label="Message">
                            <b-input maxlength="500" type="textarea" v-model="form.message"
                                     placeholder="Ton petit message pour nous..."></b-input>
                        </b-field>
                        <div class="is-flex">
                            <button class="m-auto button is-primary is-outlined" type="submit" @click.prevent="sendMail"
                                    outlined>Envoyer
                            </button>
                        </div>
                        <b-loading :is-full-page="false" :active.sync="isLoading" :can-cancel="false"></b-loading>
                    </form>
                </article>
                <article id="info" class="column ml-3">
                    <span class="mt mb">60 quai de Jemmapes 75010 Paris</span>
                    <span class="mt mb">contact@ecole-webstart.com</span>
                    <span class="mt mb">Tél: 01 42 41 97 76</span>
                </article>
            </div>
            <div class="is-flex mt mb pt">
                <iframe class="m-auto"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.348454921633!2d2.364185115674806!3d48.870633479288756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e09895be2c5%3A0x4aacd75b8377c5a0!2s60%20Quai%20de%20Jemmapes%2C%2075010%20Paris!5e0!3m2!1sfr!2sfr!4v1592069209054!5m2!1sfr!2sfr"
                        width="800" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
            </div>
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
    import navigation from "../../components/Navigation";
    import axios from 'axios'

    export default {

        name: "Contact",
        data() {
            return {
                form: {
                    nom: '',
                    prenom: '',
                    email: '',
                    sujet: '',
                    message: ''
                },

                isLoading: false,
            }
        },
        components: {
            navigation
        },

        methods: {

            openLoading() {
                this.isLoading = true
                setTimeout(() => {
                    this.isLoading = false
                }, 10 * 1000)
            },
            clearForm() {
                this.form.nom = ''
                this.form.prenom = ''
                this.form.email = ''
                this.form.sujet = ''
                this.form.message = ''
            },

            sendMail() {
                this.openLoading()
                axios.post(
                    '/api/contact',
                    {form: this.form},
                    {headers: {'Content-Type': 'application/json'}}
                )
                    .then(res => {
                            this.isLoading = false
                            this.$store.commit('toastSuccess',{msg : res.data.msg} )
                            this.clearForm()
                    })
                .catch( err => {
                    this.isLoading = false
                    this.$store.commit('toastFail', {msg : err.response.data.msg})

                })
            }
        }
    }
</script>

<style scoped lang="scss">
    #info {
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.2) 100%), url(https://www.sneakers-culture.com/wp-content/uploads/2018/09/interview-yacine-sneakers-shop-boutique-paris-2.jpg) center no-repeat;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: aliceblue;
        align-items: center;
        text-shadow: #151515 1px 1px 5px;
        font-size: 20px;

    }

    form .is-flex {
        justify-content: space-between;
    }

    @media all and (max-width: 768px) {
        .mr-3 {
            margin-right: unset !important;
        }
    }


</style>
