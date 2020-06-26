<template>
    <form action="">

        <div class="modal-card" style="max-width: 600px">
            <b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="true"></b-loading>
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Marque</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Name" expanded>
                    <b-input v-model="form.name"></b-input>
                </b-field>

                <b-field v-if="form.fileBannerName" label="banner">
                    <figure class="image is-3by2">
                        <img :src="form.fileBannerName">
                    </figure>
                </b-field>
                <b-field class="file">
                    <b-upload v-model="form.fileBanner">
                        <a class="button is-info">
                            <b-icon icon="upload"></b-icon>
                            <span>Click to upload the banner </span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="form.fileBanner">
                    {{ form.fileBanner.name }}
                    </span>
                </b-field>


                <b-field v-if="form.fileImageName" label="Logo">
                    <figure class="image is-48x48">
                        <img :src="form.fileImageName">
                    </figure>
                </b-field>
                <b-field class="file">
                    <b-upload v-model="form.fileImage">
                        <a class="button is-success">
                            <b-icon icon="upload"></b-icon>
                            <span>Click to upload the Logo </span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="form.fileImage">
                    {{ form.fileImage.name }}
                    </span>
                </b-field>


                <b-field label="Description">
                    <b-input type="textarea" v-model="form.description"></b-input>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary" @click.prevent="edit? submit($parent, brand.id) : submit($parent)">Add</button>
            </footer>
        </div>
    </form>

</template>

<script>
    import {mapActions, mapGetters, mapState} from "vuex";

    export default {
        name: "BrandForm",
        data() {
            return {
                isLoading: false,
                isFullPage: false,
                edit: false,
                form: {
                    name: '',
                    fileImage: null,
                    fileBanner: null,
                    description: '',
                    fileImageName: null,
                    fileBannerName: null
                }

            }
        },
        props: {
            brand: Object
        },
        computed: {
            ...mapGetters({
                added: 'admin/getAdded'
            })

        },
        mounted() {
            if (Object.keys(this.brand).length !== 0) {
                console.log('hehe')
                this.edit = true
                this.form = {
                    name: this.brand.name,
                    fileImageName: this.brand.image,
                    fileBannerName: this.brand.banner,
                    description: this.brand.description
                }
            } else {
                console.log('nono')
                this.form = {
                    name: '',
                    fileImage: null,
                    fileBanner: null,
                    description: '',
                    fileImageName: null,
                    fileBannerName: null
                }
            }

        },
        methods: {

            async submit(param, id) {
                this.isLoading = true
                if (!this.edit) {
                    await this.$store.dispatch('admin/createBrand', this.form)
                        .then(res => {
                            setTimeout(() => {
                                this.afterSubmit(param)
                            }, 1500)

                        })
                } else
                    await this.$store.dispatch('admin/updateBrand', {form: this.form, id: id})
                        .then(() => {
                            setTimeout(() => {
                                this.afterSubmit(param)
                            }, 1500)
                        })

            },

            afterSubmit(param) {
                if (this.added) {
                    if (this.edit)
                        this.$store.commit('toastSuccess', {msg: 'Modification avec succès ! '})
                    else
                        this.$store.commit('toastSuccess', {msg: 'Ajout avec succès ! '})
                    this.isLoading = false
                    param.close()
                } else {
                    this.isLoading = false
                    if (this.edit)
                        this.$store.commit('toastFail', {msg: 'Le champ name est Requis ! '})
                    else
                    this.$store.commit('toastFail', {msg: 'tous les champs sont requis sauf la description !'})

                }
            }

        }
    }
</script>

<style lang="scss">

    .modal-card-foot, .modal-card-head {
        background: #424242;

        p {
            color: #3dd481;
        }

    }
</style>
