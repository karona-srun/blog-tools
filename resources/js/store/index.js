import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import auth from './modules/auth.module';
import user from './modules/user.module';
import role from './modules/role.module';
import blog from './modules/blog.module';

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    plugins: [createPersistedState()],
    modules: {
        auth,
        user,
        role,
        blog
    },    
    
    state: {
        
    },
    getters: {
        
    },
    mutations: {
        
    },
    actions: {
        
    },
});
