"use strict";

import axios from 'axios';
const URL = '/api/workplaces/';

export const WorkplaceService = {

    async listWorkplaces() {
        let configs = await axios.get(URL, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await configs.data.data;
    },

    async getWorkplace(id) {
        let configs = await axios.get(URL + id, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await configs.data.data;
    },

    async saveWorkplace(data) {
        let mySavedData = await axios.post(URL, data ,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await mySavedData.data.data;
    },

    async updateWorkplace(data) {
        let mySavedData = await axios.put(URL + data.id, data ,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await mySavedData.data.data;
    },

    async removeWorkplace(id) {
        let mySavedData = await axios.delete(URL + id ,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await mySavedData.data;
    }
}
