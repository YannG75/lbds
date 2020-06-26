import axios from 'axios';

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

        afterSubmit(state, param) {
            if (state.added) {
                if (state.edit)
                    this.commit('toastSuccess', {msg: 'Modification avec succès ! '})
                else
                    this.commit('toastSuccess', {msg: 'Ajout avec succès ! '})
                state.isLoading = false
                param.close()
            } else {
                state.isLoading = false
                if (state.edit)
                    this.commit('toastFail', {msg: 'Le champ name est Requis ! '})
                else
                    this.commit('toastFail', {msg: 'tous les champs sont requis sauf la description !'})

            }
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
                    this.dispatch('GetAllBrands', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                })
        },

        async sleep({commit}, ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },

        deleteBrand({commit}, id) {
            axios.post('/api/brands/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
                this.dispatch('GetAllBrands', null, {root: true})
            })
                .catch(e => {
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },

        async updateBrand({commit, state, rootState}, {form, id}) {
            state.edit = true
            console.log(form.fileBanner)
            console.log(form.fileImage)
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
                    this.dispatch('GetAllBrands', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
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
                    this.dispatch('GetAllProducts', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                })
        },

        async updateProduct({commit, state, rootState}, {form, id}) {
            state.edit = true
            const formData = new FormData();
            formData.append("name", form.name);
            formData.append("brand", form.brand);
            formData.append("image", form.image);
            formData.append("description", form.description);
            formData.append("color", form.color);
            formData.append("price", form.price);
            formData.append("active", form.active);
            if (form.image !== undefined)
                formData.append("banner", form.image);
            if (form.images !== undefined)
                formData.append("image", form.fileImage);

            await axios.post('/api/products/update/' + id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    this.commit('admin/setAdded', true)
                    this.dispatch('GetAllBrands', null, {root: true})

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                })
        },

        deleteProduct({commit}, id) {
            axios.post('/api/products/' + id).then(res => {
                this.commit('toastSuccess', {msg: res.data.msg})
                this.dispatch('GetAllProducts', null, {root: true})
            })
                .catch(e => {
                    this.commit('toastFail', {msg: e.response.data.message})
                })
        },
    }
}
