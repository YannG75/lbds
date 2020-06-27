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
    async GetAllProducts({commit}) {
      await  axios.get('/api/products')
            .then(res => {
                commit('getProducts', res.data)
            })
    },

    async GetAllBrands({commit}) {
        await axios.get('/api/brands')
            .then(res => {
                commit('getBrands', res.data)
            })
    },

    async GetAllNews({commit}) {
       await axios.get('/api/news')
            .then(res => {
                commit('getNews', res.data)
            })
    },
    async GetNews({commit}) {
       await axios.get('/api/news/' + id)
            .then(res => {
                commit('getSingleNews', res.data)
            })
    },

   async GetBrand({commit}, id) {
      await axios.get('/api/brands/' + id)
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

    async GetProduct({commit}, id) {

       await axios.get('/api/products/' + id)
            .then(res => {
                commit('getProduct', res.data)
            })
    },

    sendOrder({commit}, order) {
        axios.post(
            '/api/order',
            order,
            {headers: {'Content-Type': 'application/json'}}
        )
            .then( res => {
                commit('confirmOrder', {state : true})
                commit('emptyCart', {state : true})

            })
            .catch(err => {
                commit('toastFail', {msg : err.response.data.msg})
                commit('confirmOrder', {state : false})

            })
    }


}

export default actions
