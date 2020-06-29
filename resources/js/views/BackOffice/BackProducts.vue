<template>
    <div>
        <h1 class="has-text-centered is-size-1 has-text-grey-light">Les Produits</h1>

        <div class="container mt mb">
            <div class="is-flex addBtn">
                <b-button size="is-medium"
                          icon-left="plus-circle" class="add is-right" @click="isComponentModalActive = true">
                    Ajouter
                </b-button>
            </div>

            <div class="card is-flex mt mb" v-for="(product, index) in getProducts" :key="index">
                <div class="is-flex">
                    <img :src="product.image" class="ml-5 mr-5" alt="product image" width="70px">
                    <h2 class="is-size-3 ml-5">{{product.name}}</h2>
                </div>

                <div class="is-flex around">
                    <b-button type="is-info"
                              icon-right="edit" @click="[edit(product),isComponentModalActive = true]"/>
                    <b-button type="is-danger"
                              icon-right="trash" :class="{'is-loading': trash && clicked === product.id}"
                              @click="[supp(product.id), trash = true, clicked = product.id]"/>
                </div>

            </div>
        </div>
        <b-modal :active.sync="isComponentModalActive"
                 has-modal-card
                 trap-focus
                 :destroy-on-hide="true"
                 aria-role="dialog"
                 aria-modal>
            <modal-form :product="changeProduct" :key="modalKey"></modal-form>
        </b-modal>
    </div>
</template>

<script>
    import ModalForm from "../../components/BackOffice/ProductForm";
    import {mapActions, mapGetters, mapMutations} from "vuex";

    export default {
        name: "BackProducts",
        data() {
            return {
                isComponentModalActive: false,
                product: {},
                modalKey: 1,
                trash: false,
                clicked: null
            }
        },
        computed: {
            ...mapGetters(['getProducts','getProduct']),
            changeProduct() {
                if (this.isComponentModalActive === false && Object.keys(this.product).length !== 0) {
                    this.modalKey--
                    return this.product = {}
                } else {
                    this.modalKey++
                    return this.product
                }

            }
        },
        mounted() {
            this.GetAllProducts()
        },
        methods: {
            ...mapActions({
                GetAllProducts: 'admin/GetAllProducts',
                askForProduct: 'admin/GetProduct'
            }),

            ...mapMutations({
                confirmDelete: 'admin/confirmDelete'
            }),

            async edit(currentProduct) {
               await this.askForProduct(currentProduct.id)
                   .then(() => {
                       this.product = this.getProduct
                   })

            },

            supp(id) {
                this.confirmDelete({ftn: 'admin/deleteProduct', id: id})
                setTimeout(() => {
                    this.trash = false
                }, 4500)
            }
        },
        components: {
            ModalForm
        }


    }
</script>

<style scoped>

</style>
