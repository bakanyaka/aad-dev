import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import users from '../app/users/vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        users
    }
})

