import axios from "axios";
import api from "../../api";

let url = api.setAPIURL() + "roles";
let header = api.setHeaders();

const state = {
    rolesList       : {},
    role            : {},
    rolePermissions : {},
    permissionsList : {},
    permissions     : {}
};
const getters = {
    rolesList       : state => state.rolesList,
    role            : state => state.role,
    rolePermissions : state => state.rolePermissions,
    permissionsList : state => state.permissionsList,
    permissions     : state => state.permissions
};

const mutations = {
    SET_ROLES   : (state, roles)    => (state.rolesList = roles),
    SET_ROLE    : (state, role)     => (state.role = role),
    SET_ROLE_PERMISSIONS : (state, rolePermissions) => (state.rolePermissions = rolePermissions),
    SET_PERMISSIONS : (state, permissions) => (state.permissions = permissions),
    SET_PERMISSIONS_LIST : (state, permissionsList) => (state.permissionsList = permissionsList),
    UPDATE_ROLE: (state, role) => (
        state.roles = state.roles.map(role => {
            if (role.id === role.id) {
            return Object.assign({}, role, role.data)
            }
            return role
        })
    ),
    REMOVE_ROLE: (state, id) => (
        state.rolesList.filter(role => role.id !== id),
        state.rolesList.splice(role => role.id, 1)
    )
};

const actions = {
    fetchRoles({ commit }) {
        axios.get(url,{
            headers: header
        }).then(response => {
            commit("SET_ROLES", response.data.data);
        })
    },
    fetchPermissions({ commit }) {
        let response = axios.get(`${url}/create`,{
            headers: header
        })
        response.then(response => {
            commit("SET_PERMISSIONS_LIST", response.data.permission)
        })
    },
    fetchRole({ commit }, id){
        axios.get(`${url}/${id}/edit`,{
            headers: header
        }).then(response => {
            commit("SET_ROLE", response.data.role);
            commit("SET_PERMISSIONS", response.data.permissions);
            commit("SET_ROLE_PERMISSIONS", response.data.rolePermissions);
        })
    },
    addNewPermissions({ commit }, data) {
        return axios.post(`${url}`, data, {
            headers: header
        }).then(response => {
            commit("SET_ROLE", response.data.role);
            commit("SET_PERMISSIONS", response.data.permissions);
            return response.data;
        })
    },
    updateRole({ commit}, data){
        return axios.patch(`${url}/${data.id}`,data,{
            headers: header
        }).then(response => {
            if( response.data.status == "Success" ){
                commit("SET_ROLE", response.data.role);
                commit("SET_PERMISSIONS", response.data.role.permissions);
                return response.data;
            } else
            return response.data;
        })
    },
    deleteRole({ commit }, id) {
        axios.delete(url+'/'+id, {
            headers: header
        });
        commit("REMOVE_ROLE", id);
    },
};
export default {
    state,
    getters,
    actions,
    mutations
};