<template>
    <form action="">

        <div class="modal-card" style="max-width: 700px">
            <b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="true"></b-loading>
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Produit</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Name" expanded>
                    <b-input v-model="form.name"></b-input>
                </b-field>
                <b-field label="Marque">
                    <b-field grouped group-multiline>
                        <p class="control" v-for="(brand, index) in getBrands" :key="index">
                            <button class="button" style="transition: all .2s ease"
                                    :class="{'is-dark' :form.brand.id === brand.id}"
                                    @click.prevent="form.brand = brand">{{brand.name}}
                            </button>
                        </p>
                    </b-field>
                </b-field>

                <b-field label="Description">
                    <b-input type="textarea" v-model="form.description"></b-input>
                </b-field>

                <b-field label="Coloris" expanded>
                    <b-input v-model="form.color"></b-input>
                </b-field>
                <b-field label="Prix (arrondi à l'unité)" expanded>
                    <b-input v-model="form.price"></b-input>
                </b-field>

                <b-field v-if="form.fileImageName" label="Image pricipale">
                    <figure class="image is-3by2">
                        <img :src="form.fileImageName">
                    </figure>
                </b-field>
                <b-field class="file">
                    <b-upload v-model="form.image">
                        <a class="button is-primary">
                            <b-icon icon="upload"></b-icon>
                            <span>Click to upload the Principal Image </span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="form.image">
                    {{ form.image.name }}
                    </span>
                </b-field>


                <b-field v-if="form.fileImagesName" label="Images secondaire (suppression instantanée)">
                    <b-field grouped group-multiline>

                        <figure v-for="(item, index) in form.fileImagesName" :key="index"
                                class="image is-96x96 control is-relative">
                            <img :src="item.image">
                            <i class="fas fa-times-circle sup has-text-danger" @click="delImage(item.id, index)"></i>
                        </figure>
                    </b-field>
                </b-field>
                <b-field :label="form.fileImagesName? '' : 'Images secondaire'">
                    <b-upload v-model="form.images"
                              multiple
                              drag-drop>
                        <section class="section">
                            <div class="content has-text-centered">
                                <p>
                                    <b-icon
                                        icon="upload"
                                        size="is-large">
                                    </b-icon>
                                </p>
                                <p>Click ou Drag and Drop pour inserer tes images ici</p>
                            </div>
                        </section>
                    </b-upload>
                </b-field>

                <div class="tags">
            <span v-for="(file, index) in form.images"
                  :key="index"
                  class="tag is-primary">
                {{file.name}}
                <button class="delete is-small"
                        type="button"
                        @click="deleteDropFile(index)">
                </button>
            </span>
                </div>

                <b-field label="Produit actif">
                    <b-switch
                        v-model="form.active"
                        passive-type='is-dark'
                        type='is-warning'>
                        {{ form.active ? 'Oui' : 'Non' }}
                    </b-switch>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary" @click.prevent="edit? submit($parent, product.id) : submit($parent)">
                    Add
                </button>
            </footer>
        </div>
    </form>

</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";

    export default {
        name: "ProductForm",
        data() {
            return {
                isLoading: this.getIsLoading,
                isFullPage: false,
                edit: this.getEdit,
                load: null,
                form: {
                    name: '',
                    brand: '',
                    description: '',
                    color: '',
                    price: '',
                    image: null,
                    fileImageName: null,
                    fileImagesName: null,
                    images: [],
                    active: false
                }


            }

        },

        computed: {
            ...mapGetters({
                getBrands: 'getBrands',
                getProduct: 'getProduct',
                getEdit: 'admin/getEdit',
                getIsLoading: 'admin/getIsLoading',
                added: 'admin/getAdded'
            }),

        },
        props: {
            product: Object
        },

        mounted() {
            this.GetAllBrands().then(() => {
                if (Object.keys(this.product).length !== 0) {
                    let currentBrand
                    this.getBrands.forEach(brand => {
                        if (this.product.brand === brand.name) {
                            currentBrand = brand
                        }
                    })

                    this.form = {
                        name: this.product.name,
                        description: this.product.description,
                        brand: currentBrand,
                        color: this.product.color,
                        price: this.product.price,
                        image: null,
                        fileImageName: this.product.image,
                        fileImagesName: this.product.images,
                        images: [],
                        active: Boolean(this.product.actif),
                    }
                    this.edit = true
                }
            })


        },

        methods: {
            ...mapActions({
                GetAllBrands: 'GetAllBrands',
                GetProduct: 'GetProduct',
                deleteImage: 'admin/deleteImage'
            }),

            ...mapMutations({
                afterSubmit: 'admin/afterSubmit',

            }),

            deleteDropFile(index) {
                this.form.images.splice(index, 1)
            },

            delImage(id, index) {
                this.deleteImage(id)
                    .then(() => {
                        this.product.images.splice(index, 1)
                    })
            },

            async submit(param, id) {
                this.isLoading = true
                if (!this.edit) {
                    await this.$store.dispatch('admin/createProduct', this.form)
                        .then(res => {
                            setTimeout(() => {
                                if (this.added){
                                    param.close()
                                }
                            }, 300)
                            this.isLoading = false
                        })
                } else
                    await this.$store.dispatch('admin/updateProduct', {form: this.form, id: id})
                        .then(() => {
                            setTimeout(() => {
                                if (this.added){
                                    param.close()
                                }
                            }, 300)
                            this.isLoading = false
                        })

            },

        }
    }
</script>

<style scoped lang="scss">

    .sup {
        position: absolute;
        right: -12px;
        top: -7px;
        cursor: pointer;
        margin-left: 5px;
    }
</style>
