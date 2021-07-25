import axios from "axios";
import api from "../../api";

let url = api.setAPIURL() + "users";
let header = api.setHeaders();

const state = {
    users       : [],
    user        : [],
    roles       : [],
    userRoles   : []
};
const getters = {
    usersList   : state => state.users,
    user        : state => state.user,
    roles       : state => state.roles,
    userRoles   : state => state.userRoles
};
const actions = {
    async fetchUsers({ commit }) {
        const response = await axios.get(url, {
            headers: header
        });
        commit("SET_USERS", response.data.users);
    },
    async addUsers({ commit }, user) {
        return await axios.post(url, user , {
            headers: header
        }).then(response => {
            commit("ADD_NEW_USER", response.data.data);
            return response.data
        }).catch(error => {
            console.log(error);
        })
    },
    async editUser({ commit }, id){
        let urlEditUser = url+'/'+id +'/'+ 'edit';
        const response = await axios.get(urlEditUser, {
            headers: header
        });
        let listOfObjects = Object.keys(response.data.roles).map((key) => {
            return response.data.roles[key]
        })
        let listOfUserRoles = Object.keys(response.data.userRoles).map((key) => {
            return response.data.userRoles[key]
        })
        commit("SET_USER", response.data.user);
        commit("SET_ROLES", listOfObjects);
        commit("SET_USER_ROLES", listOfUserRoles);
    },
    async updateUser({ commit }, data) {
        return await axios.patch(url+'/'+data.id, data , {
            headers: header
        }).then(response => {
            commit("UPDATE_USER", data.id);
            return response.data
        });
    },
    async deleteUser({ commit }, id) {
        await axios.delete(url+'/'+id, {
            headers: header
        });
        commit("REMOVE_USER", id);
    },
};
const mutations = {
    SET_USERS: (state, users) => (state.users = users),
    SET_USER: (state, user) => (state.user = user),
    SET_ROLES: (state, roles) => (state.roles = roles),
    SET_USER_ROLES: (state, userRoles) =>  (state.userRoles = userRoles),
    ADD_NEW_USER: (state, user) => state.users.unshift(user),
    UPDATE_USER: (state, user) => (
        state.users = state.users.map(user => {
            if (user.id === user.id) {
            return Object.assign({}, user, user.data)
            }
            return user
        })
    ),
    REMOVE_USER: (state, id) => (
        state.users.filter(user => user.id !== id),
        state.users.splice(user => user.id, 1)
    )
};

export default {
    state,
    getters,
    actions,
    mutations
};
