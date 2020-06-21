import {ToastProgrammatic as Toast} from 'buefy'

const mutations = {
    getLastNews(state, lastNews) {
        state.lastNews = lastNews
    },
    getRandomProducts(state, randomProducts) {
        state.randomProducts = randomProducts
    },
    getProducts(state, Products) {
        state.products = Products
    },

    getBrands(state, Brands) {
        state.brands = Brands
    },

    getNews(state, News) {
        state.news = News
    },

    getBrand(state, Brand) {
        state.brand = Brand
    },

    capitalize(state, value) {
        if (!value) return ''
        value = value.toString()
        state.search = value.charAt(0).toUpperCase() + value.slice(1)
    },

    getSearchResult(state, value) {
        state.searchResult = value
    },

    getProduct(state, value) {
        state.product = value
    },

    toastSuccess(state, value) {
        console.log('yes')
        Toast.open({
            message: value.msg,
            type: 'is-success'
        })
    },
    toastFail(state, value) {
        Toast.open({
            duration: 5000,
            message: value.msg,
            position: 'is-bottom',
            type: 'is-danger'
        })
    },

    addToCart(state, value) {
        this.commit('toastSuccess', {msg: "yay c'est dans le panier !"})
        let stop = false
            state.cart.products.forEach(item => {
                if ((item.id === value.id) && item.size === value.size) {
                    item.quantity++
                    stop = true
                }

            })
        if (stop)
            return
        state.cart.products.push(value)
    },

}

export default mutations
