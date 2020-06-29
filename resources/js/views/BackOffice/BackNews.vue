<template>
    <div>
        <h1 class="has-text-centered is-size-1 has-text-grey-light">Les News</h1>

        <div class="container mt mb">
            <div class="is-flex addBtn">
                <b-button size="is-medium"
                          icon-left="plus-circle" class="add is-right" @click="isComponentModalActive = true">
                    Add
                </b-button>
            </div>

            <div class="card is-flex mt mb" v-for="(news, index) in getNews" :key="index">
                <div class="is-flex">
                    <img :src="news.image" class="ml-5 mr-5" alt="news logo" width="70px">
                    <h2 class="is-size-5 ml-5">{{news.title}}</h2>
                </div>

                <div class="is-flex around">
                    <b-button type="is-info"
                              icon-right="edit" @click="[edit(news),isComponentModalActive = true]"/>
                    <b-button type="is-danger"
                              icon-right="trash" :class="{'is-loading': trash && clicked === news.id}"  @click="[supp(news.id), trash = true, clicked = news.id]"/>
                </div>

            </div>
        </div>
        <b-modal :active.sync="isComponentModalActive"
                 has-modal-card
                 trap-focus
                 :destroy-on-hide="true"
                 aria-role="dialog"
                 aria-modal>
            <modal-form :news="changeNews" :key="modalKey"></modal-form>
        </b-modal>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import ModalForm from "../../components/BackOffice/ArticleForm";

    export default {
        name: "BackNews",
        data() {
            return {
                isComponentModalActive: false,
                news: {},
                modalKey: 1,
                trash: false,
                clicked: null
            }
        },
        computed: {
            ...mapGetters(['admin/getNews']),
            changeNews() {
                if (this.isComponentModalActive === false && this.news.length !== 0){
                    this.modalKey--
                    return this.news = {}
                }
                else
                {
                    this.modalKey++
                    return this.news
                }

            }
        },
        mounted() {
            this.GetAllNews()
        },
        methods: {
            ...mapActions({
                GetAllNews: 'admin/GetAllNews',

            }),

            ...mapMutations({
                confirmDelete: 'admin/confirmDelete'
            }),

            edit(currentNews) {
                this.news = currentNews
            },

             supp(id) {
                this.confirmDelete({ftn: 'admin/deleteNews' ,id: id})
                setTimeout(() => {
                    this.trash = false
                },4500)

            }
        }, components: {
            ModalForm
        },

    }
</script>

<style scoped>

</style>
