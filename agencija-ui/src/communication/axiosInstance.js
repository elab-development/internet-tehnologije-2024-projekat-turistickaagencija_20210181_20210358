import axios from 'axios';

const token = window.sessionStorage.getItem('token');
const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;
const role = user ? window.sessionStorage.getItem('role') : null;
const isAdminOrAgent = role === 'admin' || role === 'agent';

const url = isAdminOrAgent ? 'http://127.0.0.1:8000/api/' + role +'/' : 'http://127.0.0.1:8000/api/';

const axiosInstance = axios.create({
    baseURL: url,
    timeout: 20000
});


if (token) {
    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default axiosInstance;
