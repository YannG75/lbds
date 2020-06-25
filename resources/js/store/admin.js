import axios from 'axios';

export default {
    namespaced: true,

    state: {
        added: false
    },

    getters: {
        getAdded: state => {
            return state.added
        },
    },

    mutations: {
         setAdded(state, value) {
             state.added = value
        }
    },

    actions: {
        async createBrand({commit, state, rootState}, form) {

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
                .then( res => {
                     this.commit('admin/setAdded', true)
                     this.dispatch('GetAllBrands', null, { root: true })

                })

                .catch(e => {
                    this.commit('admin/setAdded', false)
                })
        },

        async sleep({commit},ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },

        delete({commit}, id) {
             axios.post('/api/brands/'+id).then(res => {
                 this.commit('toastSuccess', {msg: res.data.msg})
                 this.dispatch('GetAllBrands', null, { root: true })
             })
                 .catch(e =>{
                     this.commit('toastFail', {msg: e.response.data.message})
                 })
        }
    }
}
