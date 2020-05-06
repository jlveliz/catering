import axios from 'axios';

export let axiosInstance = axios.create({
    headers: {
        common: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
    }
})
