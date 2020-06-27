const getters = {
    getLastNews: state => {
        return state.lastNews
    },

    getRandomProducts: state => {
        return state.randomProducts
    },

    getProducts: state => {
        return state.products
    },

    getBrands: state => {
        return state.brands
    },

    getNews: state => {
        return state.news
    },
    getSingleNews: state => {
        return state.singleNews
    },

    getBrand: state => {
        return state.brand
    },

    getSearchResult: state => {
        return state.searchResult
    },

    getProduct: state => {
        return state.product
    },


}
export default getters

