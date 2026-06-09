import axios from 'axios';

const http = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    }
});

export const getRequest = (endpoint) => http.get(endpoint);
export const postRequest = (endpoint, data) => http.post(endpoint, data);
export const putRequest = (endpoint, data) => http.put(endpoint, data);
export const deleteRequest = (endpoint) => http.delete(endpoint);

export const authenticateLoginRequest = (data) => axios.get('/sanctum/csrf-cookie').then(Response =>{
        postRequest('/login', data)
    });