/**
 *
 */
import axios from 'axios';

const client =   axios.create({
    baseURL: process.env.VUE_APP_APP_URL,
});
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