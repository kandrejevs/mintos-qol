/**
 * Wrapper for axios client that sets base url for api instance and attaches Authorization header if token is present
 * in local storage
 */
import axios from 'axios';

const client =   axios.create({
    baseURL: process.env.VUE_APP_APP_URL,
});

/**
 * Intercept requests and attach Authorization header if token is present
 */
client.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    }

    return config;
}, function (error) {
    return Promise.reject(error);
});

export default client;