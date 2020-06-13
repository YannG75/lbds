const mutations = {
    getLastNews (state, lastNews) {
        state.lastNews = lastNews
    },
    getRandomProducts (state, randomProducts) {
        state.randomProducts = randomProducts
    },
    getProducts (state, Products) {
        state.products = Products
    },

    getBrands (state, Brands) {
        state.brands = Brands
    },

    getNews (state, News) {
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









}

export default mutations
