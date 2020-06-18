"use strict";

import axios from 'axios';

export const UserService = {

    async listUsers() {
        let users = await axios.get('/api/users', { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await users.data.data;
    },

    async getUser(id) {
        let user = await axios.get('/api/users/' + id, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await user.data.data;
    },

    async removeUser(id) {
          
    },

    async saveItemConfig(data) {
        let mySavedData = await axios.post('/api/users', data, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await mySavedData.data.data;
    },

}
