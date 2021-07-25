import axios from 'axios';
import authHeader from '../services/auth-header';

const API_URL = 'http://localhost:8000/api/auth/';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'login', user)
      .then((response) => {
        if (response.data.access_token) { 
          localStorage.setItem('accessToken', JSON.stringify(response.data.access_token));
        }
        return response.data;
      });
  }
  logout() {
    localStorage.removeItem('accessToken');
    localStorage.removeItem('userPermissions');
  }
  register(user) {
    return axios.post(API_URL + 'register',user);
  }
}

export default new AuthService();