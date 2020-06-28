<template>
    <div>
        <navigation></navigation>
        <div class="container pb">
            <b-loading  :active.sync="isLoading" ></b-loading>
            <b-steps class="mt" v-model="activeStep">
                <b-step-item label="Adresse " icon="address-card" :clickable=false>
                    <Personal :form="form" :error="error" :v="$v"></Personal>
                </b-step-item>
                <b-step-item label="Informations bancaire" icon="credit-card" :clickable=false>
                    <Payment ref="child"></Payment>
                </b-step-item>
                <b-step-item label="Recap" icon="thumbs-up" :clickable=false>
                    <Recap :form="form" :payment="payment" :cart="cart"></Recap>
                </b-step-item>
                <b-step-item label="Confirm" icon="check-circle">
                    <Confirm></Confirm>
                </b-step-item>

                <template
                    v-if="customNavigation"
                    slot="navigation"
                    slot-scope="{previous, next}">
                    <div class="is-flex around">
                        <b-button
                            v-if=" activeStep < 3"
                            outlined
                            type="is-danger"
                            icon-pack="fas"
                            icon-left="backward"
                            :disabled="previous.disabled"
                            @click.prevent="previous.action">
                            Back
                        </b-button>
                        <b-button
                            v-if=" activeStep < 3"
                            type="is-success"
                            icon-pack="fas"
                            icon-right="forward"
                            :disabled="next.disabled"
                            @click.prevent="[submit(next), error ? '' : next.action()]">
                            {{activeStep === 2 ? 'Confirmer la commande' : 'Valider'}}
                        </b-button>
                    </div>

                </template>
            </b-steps>
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
    import navigation from "../../components/Front/Navigation";
    import Personal from "../../components/Front/Personal";
    import Payment from "../../components/Front/Payment";
    import Recap from "../../components/Front/Recap";
    import Confirm from "../../components/Front/Confirm";
    import {required, email} from "vuelidate/lib/validators";

    export default {
        name: "Order",
        components: {
            Personal,
            Payment,
            Recap,
            Confirm,
            navigation
        },
        data() {
            return {
                customNavigation: true,
                activeStep: 0,
                form: {
                    lastname: '',
                    firstname: '',
                    email: '',
                    address: ''
                },
                cart: {},
                error: false,
                payment: {},
                isLoading: false,
                isFullPage: true

            }
        },
        beforeMount() {
            if (!localStorage.cart) {
                window.location.replace('/')
            }

            this.cart = JSON.parse(localStorage.cart)

        },
        validations: {
            form: {
                lastname: {
                    required
                },
                firstname: {
                    required,
                },
                email: {
                    required,
                    email
                },
                address: {
                    required
                }
            },


        },
        methods: {
           async submit(info) {

                switch (this.activeStep) {
                    case 0 :
                        this.$v.form.$touch()
                        if (this.$v.$invalid) {
                            this.error = true
                        } else {
                            this.error = false
                        }
                        break
                    case 1:
                        this.$refs.child.$v.$touch()
                        if (this.$refs.child.$v.$invalid)
                            this.error = true
                        else
                            this.payment = {
                                cardName: this.$refs.child.cardName,
                                cardNumber: this.$refs.child.cardNumber,
                                cardMonth: this.$refs.child.cardMonth,
                                cardYear: this.$refs.child.cardYear,
                            }
                        this.error = false
                        break

                    case 2:
                        this.openLoading()
                            this.error = true
                         await this.$store.dispatch('sendOrder', {customer: this.form, products: this.cart.products})

                            await this.sleep(4500).then( ()=> {

                                if (this.$store.state.order_success)
                                {
                                    this.isLoading = false
                                    this.error =false
                                    info.action()
                                    localStorage.removeItem('cart')
                                }
                            })


                        break

                }


            },
            async sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            },

            openLoading() {
                this.isLoading = true
                setTimeout(() => {
                    this.isLoading = false
                }, 10 * 1000)
            }
        }
    }
</script>

<style lang="scss">
    .b-steps {
        padding: 5px;
    }

    .loading-icon {

    }

    .around {
        justify-content: space-around;
    }

    .between {
        justify-content: space-between;
    }

    .error {
        color: #ff777d !important;

        label {
            color: #ff777d !important;
        }


        input {
            border-color: #ff777d !important;
            box-shadow: #ff777d 0 1px 2px !important;
        }

        animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both;
        transform: translate3d(0, 0, 0);
        backface-visibility: hidden;
        perspective: 1000px;

        @keyframes shake {
            10%, 90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%, 80% {
                transform: translate3d(2px, 0, 0);
            }

            30%, 50%, 70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%, 60% {
                transform: translate3d(4px, 0, 0);
            }
        }
    }
</style>
