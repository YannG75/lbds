import axios from 'axios';

const actions = {
    GetLastNews({commit}) {
        axios.get('/api/news/latest')
            .then(res => {
                commit('getLastNews', res.data)
            })
    },
    GetRandomProducts({commit}) {
        axios.get('/api/products?sort=random&max=10')
            .then(res => {
                commit('getRandomProducts', res.data)
            })
    },
    GetAllProducts({commit}) {
        axios.get('/api/products')
            .then(res => {
                commit('getProducts', res.data)
            })
    },

    GetAllBrands({commit}) {
        axios.get('/api/brands')
            .then(res => {
                commit('getBrands', res.data)
            })
    },

    GetAllNews({commit}) {
        axios.get('/api/news')
            .then(res => {
                commit('getNews', res.data)
            })
    },

    GetBrand({commit}, id) {
        axios.get('/api/brands/' + id)
            .then(res => {
                commit('getBrand', res.data)
            })
    },

    GetSearchResult({commit, state}, search) {
        commit('capitalize', search)

        axios.get('/api/products?search=' + state.search)
            .then(res => {
                commit('getSearchResult', res.data)
            })
    },

    GetResult({commit, state}, id) {

        axios.get('/api/products?search=' + state.search + '&page=' + id)
            .then(res => {
                commit('getSearchResult', res.data)
            })
    },

    GetProduct({commit}, id) {

        axios.get('/api/products/' + id)
            .then(res => {
                commit('getProduct', res.data)
            })
    },


}

export default actions
