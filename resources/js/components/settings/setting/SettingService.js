"use strict";

import axios from 'axios';

export const SettingService = {

    async listServices(type) {
        let services = await axios.get('/api/settings/' + type, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await services.data.data;
    },

    async saveItemConfig(data) {
        let mySavedData = await axios.put('/api/settings/' + data.id, data ,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await mySavedData.data.data;
    },

    async saveAllForm(collection) {
        let data = {} 
        for (const key in collection) {
            data[key] = await this.saveItemConfig(collection[key],collection[key].id)
        }
        return data;
    }
}