import axios from 'axios';
import { DialogProgrammatic as Dialog } from 'buefy'
export default {
    namespaced: true,

    state: {
        added: false,
        isLoading: false,
        isFullPage: false,
        edit: false,
    },

    getters: {
        getAdded: state => {
            return state.added
        },

        getEdit: state => {
            return state.edit
        },

        getIsLoading: state => {
            return state.isLoading
        },


    },


    mutations: {
        setAdded(state, value) {
            state.added = value
        },

        async confirmDelete(state, {ftn , id}) {
           await Dialog.confirm({
                title: 'Suppression',
                message: 'Êtes-vous sur de vouloir <b>supprimer</b> ceci ?',
                confirmText: 'Oui !',
                type: 'is-danger',
                hasIcon: true,
                onConfirm: () => this.dispatch(ftn, id)
            })
        }

    },

    actions: {
        async createBrand({commit, state, rootState}, form) {
            state.edit = false
            const formData = new FormData();
            formData.append("name", form.name);
            formData.append("banner", form.fileBanner);
            formData.append("image", form.fileImage);
            formData.append("description", form.description);
            await axios.post('/api/brands',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllBrands', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async sleep({commit}, ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },

        deleteBrand({commit}, id) {
            axios.delete('/api/brands/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
                this.dispatch('GetAllBrands', null, {root: true})
            })
                .catch(e => {
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async updateBrand({commit, state, rootState}, {form, id}) {
            state.edit = true
            const formData = new FormData();
            formData.append("name", form.name);
            formData.append("description", form.description);
            if (form.fileBanner !== undefined)
                formData.append("banner", form.fileBanner);
            if (form.fileImage !== undefined)
                formData.append("image", form.fileImage);

            await axios.post('/api/brands/update/' + id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllBrands', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },


        async createProduct({commit, state, rootState}, form) {
            state.edit = false
            const formData = new FormData();
            let actif = form.active ? 1 : 0
            formData.append("name", form.name);
            formData.append("brand", form.brand.name);
            formData.append("brand_id", form.brand.id);
            formData.append("image", form.image);
            formData.append("description", form.description);
            for (let i = 0; i <= form.images.length; i++) {
                formData.append('images[]', form.images[i]);
            }
            formData.append('images', form.images);
            formData.append("color", form.color);
            formData.append("price", form.price);
            formData.append("actif", actif);
            await axios.post('/api/products',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllProducts', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async updateProduct({commit, state, rootState}, {form, id}) {
            state.edit = true
            let actif = form.active ? 1 : 0
            const formData = new FormData();
            formData.append("name", form.name);
            formData.append("brand", form.brand.name);
            formData.append("brand_id", form.brand.id);
            formData.append("description", form.description);
            formData.append("color", form.color);
            formData.append("price", form.price);
            formData.append("actif", actif);
            if (form.image !== null)
                formData.append("image", form.image);
            if (form.images.length !== 0)
                for (let i = 0; i <= form.images.length; i++) {
                    formData.append('images[]', form.images[i]);
                }

            await axios.post('/api/products/update/' + id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllProducts', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async deleteProduct({commit}, id) {
            await axios.delete('/api/products/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
                this.dispatch('GetAllProducts', null, {root: true})
            })
                .catch(e => {
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },
        async deleteImage({commit}, id) {
            await axios.delete('/api/products/image/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
            }).catch(e => {
                this.commit('toastFail', {msg: e.response.data.message})
            })
        },

        async createNews({commit, state, rootState}, {form, moment}) {
            state.edit = false
            const formData = new FormData();
            let actif = form.is_published ? 1 : 0
            let author = rootState.auth.user.id
            formData.append("title", form.title);
            formData.append("image", form.image);
            formData.append("content", form.content);
            formData.append("summary", form.summary);
            formData.append('banner', form.banner);
            formData.append("author", author);
            formData.append("publish_date", moment(form.publish_date).format('YYYY-MM-DD HH:mm:ss'));
            formData.append("is_published", actif);
            await axios.post('/api/news',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllNews', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async updateNews({commit, state, rootState}, {form,id ,moment}) {
            state.edit = true
            const updateForm = new FormData();
            let actif = form.is_published ? 1 : 0
            let author = rootState.auth.user.id
            updateForm.append("title", form.title);
            updateForm.append("content", form.content);
            updateForm.append("summary", form.summary);
            updateForm.append("author", author);
            updateForm.append("publish_date", moment(form.publish_date).format('YYYY-MM-DD HH:mm:ss'));
            updateForm.append("is_published", actif);
            if (form.image !== null)
                updateForm.append("image", form.image);
            if (form.banner !== null)
                updateForm.append("banner", form.banner);
            await axios.post('/api/news/'+id,
                updateForm,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.commit('toastSuccess', {msg: res.data.msg})
                    this.dispatch('GetAllNews', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },


        async deleteNews({commit}, id) {
            await axios.delete('/api/news/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
                this.dispatch('GetAllNews', null, {root: true})
            }).catch(e => {
                this.commit('toastFail', {msg: e.response.data.message})
            })
        },


    }
}
