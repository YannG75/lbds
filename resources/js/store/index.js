import Vue from 'vue'
import Vuex from 'vuex'
import state from "./state";
import actions from "./actions";
import mutations from "./mutations";
import getters from "./getters";
import auth from "./auth";
import admin from "./admin";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        admin
    },

    state,
    mutations,
    actions,
    getters
})
