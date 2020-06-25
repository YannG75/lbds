<template>
    <form action="">

        <div class="modal-card" style="max-width: 500px">
            <b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="true"></b-loading>
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Brand</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Name" expanded>
                    <b-input v-model="form.name"></b-input>
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
                <button class="button is-primary"  @click.prevent="submit($parent)">Add</button>
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
                form: {
                    name: '',
                    fileImage: null,
                    fileBanner: null,
                    description: ''
                }

            }
        },
        computed: {
          ...mapGetters({
              added: 'admin/getAdded'
          })

        },
        mounted() {
        },
        methods: {

            async submit(param) {
                this.isLoading = true
                await this.$store.dispatch('admin/createBrand', this.form)
                .then( res => {
                    setTimeout(()=> {
                        this.afterSubmit(param)
                    }, 1500)

                })
            },

             afterSubmit(param) {
                if (this.added) {
                    this.$store.commit('toastSuccess', {msg: 'Ajout avec succès ! '})
                    this.isLoading = false
                    this.form =  {
                        name: '',
                        fileImage: null,
                        fileBanner: null,
                        description: ''
                    }
                    param.close()
                }
                else {
                    this.isLoading = false
                    this.$store.commit('toastFail', {msg: 'tous les champs sont requis sauf la description !'})

                }
            }

        }
    }
</script>

<style scoped lang="scss">

    .modal-card-foot, .modal-card-head {
        background: #424242;

        p {
            color: #3dd481;
        }

    }
</style>
