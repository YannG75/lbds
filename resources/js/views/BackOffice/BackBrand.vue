<template>
    <div>
        <h1 class="has-text-centered is-size-1 has-text-grey-light">Les Marques</h1>

        <div class="container mt mb">
            <div class="is-flex addBtn">
                <b-button size="is-medium"
                          icon-left="plus-circle" class="add is-right" @click="isComponentModalActive = true">
                    Add
                </b-button>
            </div>

            <div class="card is-flex mt mb" v-for="(brand, index) in getBrands" :key="index">
                <div class="is-flex">
                    <img :src="brand.image" class="ml-5 mr-5" alt="brand logo" width="70px">
                    <h2 class="is-size-3 ml-5">{{brand.name}}</h2>
                </div>

                <div class="is-flex around">
                    <b-button type="is-info"
                              icon-right="edit" />
                    <b-button type="is-danger"
                              icon-right="trash" @click="deleteBrand(brand.id)"/>
                </div>

            </div>
        </div>
        <b-modal :active.sync="isComponentModalActive"
                 has-modal-card
                 trap-focus
                 :destroy-on-hide="false"
                 aria-role="dialog"
                 aria-modal>
            <modal-form></modal-form>
        </b-modal>
    </div>
</template>

<script>
    import ModalForm from "../../components/BackOffice/BrandForm";
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "BackBrand",
        data() {
            return {
                isComponentModalActive: false,

            }
        },
        computed: {
            ...mapGetters(['getBrands'])
        },
        mounted() {
            this.GetAllBrands()
        },
        methods: {
            ...mapActions({
                GetAllBrands : 'GetAllBrands',
                deleteBrand : 'admin/delete'
            }),
        },components: {
            ModalForm
        },

    }
</script>

<style scoped lang="scss">
    .card {
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .is-flex {
        img {
            object-fit: contain;
        }
    }

    .around {
        justify-content: space-around;
        width: 150px;
    }
    .addBtn {
        max-width: 900px;
        margin: auto;
        justify-content: flex-end;
        .add {
            color: #3dd481;
        }
    }



</style>
