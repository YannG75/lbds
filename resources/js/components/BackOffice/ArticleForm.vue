<template>
    <form action="">

        <div class="modal-card" style="max-width: 600px">
            <b-loading :is-full-page="isFullPage" :active="isLoading" :can-cancel="true"></b-loading>
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">News</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Titre" expanded>
                    <b-input v-model="form.title"></b-input>
                </b-field>

                <b-field label="Résumé" expanded>
                    <b-input v-model="form.summary"></b-input>
                </b-field>

                <b-field label="Le contenu">
                    <b-input type="textarea" v-model="form.content"></b-input>
                </b-field>

                <b-field v-if="form.BannerName" label="La bannière">
                    <figure class="image is-3by2">
                        <img :src="form.BannerName">
                    </figure>
                </b-field>
                <b-field class="file">
                    <b-upload v-model="form.banner">
                        <a class="button is-primary">
                            <b-icon icon="upload"></b-icon>
                            <span>Click to upload the banner </span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="form.banner">
                    {{ form.banner.name }}
                    </span>
                </b-field>


                <b-field v-if="form.ImageName" label="Image">
                    <figure class="image is-96x96">
                        <img :src="form.ImageName">
                    </figure>
                </b-field>
                <b-field class="file">
                    <b-upload v-model="form.image">
                        <a class="button is-dark">
                            <b-icon icon="upload"></b-icon>
                            <span>Click to upload the image </span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="form.image">
                    {{ form.image.name }}
                    </span>
                </b-field>

                <b-field label="Date de publication">
                    <b-datetimepicker v-model="form.publish_date"
                                      icon="calendar-check"
                                      placeholder="Click to select...">
                        <template slot="left">
                            <button class="button is-primary"
                                    @click.prevent="form.publish_date = new Date()">
                                <b-icon icon="clock"></b-icon>
                                <span>Now</span>
                            </button>
                        </template>
                        <template slot="right">
                            <button class="button is-danger"
                                    @click.prevent="form.publish_date = null">
                                <b-icon icon="times"></b-icon>
                                <span>Clear</span>
                            </button>
                        </template>
                    </b-datetimepicker>
                </b-field>

                <b-field label="News Publié">
                    <b-switch
                        v-model="form.is_published"
                        passive-type='is-dark'
                        type='is-warning'>
                        {{ form.is_published ? 'Oui' : 'Non' }}
                    </b-switch>
                </b-field>


            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary" @click.prevent="edit? submit($parent, news.id) : submit($parent)">Add</button>
            </footer>
        </div>
    </form>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "ArticleForm",
        data() {
            return {
                isLoading: false,
                isFullPage: false,
                edit: false,
                form: {
                    title: '',
                    image: null,
                    banner: null,
                    ImageName: null,
                    BannerName: null,
                    content: '',
                    summary: '',
                    publish_date: new Date(),
                    is_published: false
                }

            }
        },
        props: {
            news: Object
        },
        computed: {
            ...mapGetters({
                added: 'admin/getAdded'
            })

        },
        mounted() {
            if (Object.keys(this.news).length !== 0) {
                this.edit = true
                this.form = {
                    title: this.news.title,
                    ImageName: this.news.image,
                    image: null,
                    banner: null,
                    BannerName: this.news.banner,
                    content: this.news.content,
                    summary: this.news.summary,
                    publish_date: this.news.publish_date === '0000-00-00' ? new Date(): new Date(this.news.publish_date),
                    is_published: Boolean(this.news.is_published)

                }

            }

        },
        methods: {

            async submit(param, id) {
                this.isLoading = true
                if (!this.edit) {

                    await this.$store.dispatch('admin/createNews', {form: this.form, moment: this.$moment})
                        .then(res => {
                            setTimeout(() => {
                                if (this.added){
                                    param.close()
                                }
                            }, 300)
                            this.isLoading = false
                        })
                } else
                    await this.$store.dispatch('admin/updateNews', {form: this.form, id: id, moment: this.$moment})
                        .then(() => {
                            setTimeout(() => {
                                if (this.added){
                                    param.close()
                                }
                            }, 300)
                        })
                this.isLoading = false

            },

        }
    }
</script>

<style scoped>

</style>
