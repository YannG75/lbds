<template>
    <div>
        <h1 class="has-text-centered is-size-1 has-text-grey-light">Les Marques</h1>

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
                              icon-right="trash" @click="deleteProduct(product.id)"/>
                </div>

            </div>
        </div>
        <b-modal :active.sync="isComponentModalActive"
                 has-modal-card
                 trap-focus
                 :destroy-on-hide="false"
                 aria-role="dialog"
                 aria-modal>
            <modal-form :product="changeProduct" :key="modalKey"></modal-form>
        </b-modal>
    </div>
</template>

<script>
    import ModalForm from "../../components/BackOffice/ProductForm";
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "BackProducts",
        data() {
            return {
                isComponentModalActive: false,
                productId: {},
                modalKey: 1
            }
        },
        computed: {
            ...mapGetters(['getProducts']),
            changeProduct() {
                if (this.isComponentModalActive === false && this.productId.length !== 0) {
                    this.modalKey--
                    return this.productId = ''
                } else {
                    this.modalKey++
                    return this.productId
                }

            }
        },
        mounted() {
            this.GetAllProducts()
        },
        methods: {
            ...mapActions({
                GetAllProducts: 'GetAllProducts',
                deleteProduct: 'admin/deleteProduct'
            }),

            edit(currentProduct) {
                this.productId = currentProduct.id
            }
        },
        components: {
            ModalForm
        }


    }
</script>

<style scoped>

</style>
