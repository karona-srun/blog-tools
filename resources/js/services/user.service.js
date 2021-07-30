import axios from 'axios';
import authHeader from './auth-header';
import api from '../api';

const API_URL = api.setAPIURL();

class UserService {
  getPublicContent() {
    return axios.get(API_URL + 'all');
  }

  getUserBoard() {
    return axios.get(API_URL + 'auth/user', { headers: authHeader() }).then(response =>{
        localStorage.setItem('users',response.data)
        localStorage.setItem("userPermissions", response.data.permissions);
        localStorage.setItem('users',response.data.data)
        return response.data
    });
  }

  getModeratorBoard() {
    return axios.get(API_URL + 'mod', { headers: authHeader() });
  }

  getAdminBoard() {
    return axios.get(API_URL + 'admin', { headers: authHeader() });
  }

  getRoles() {
    return axios.get(API_URL + 'roles', { headers: authHeader() }).then(response =>{
        let roles = response.data.data
        return roles;  
    });
  }

  getRolesForUsersCreate() {
    return axios.get(API_URL + 'users/create', { headers: authHeader() }).then(response =>{
        let roles = response.data.roles
        return roles;  
    });
  }

  getUsers() {
    return axios.get(api.setAPIURL() + 'users', { headers: api.setHeaders() }).then(response =>{
        let users = response.data.data
        return users;  
    });
  }
}

export default new UserService();