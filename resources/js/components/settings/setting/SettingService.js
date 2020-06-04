"use strict";

import axios from 'axios';

export const SettingService = {

    async listConfig(type) {
        let configs = await axios.get('/api/settings/' + type, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await configs.data.data;
    },

    async saveItemConfig(data) {
        let mySavedData = await axios.put('/api/settings/' + data.table + '/' + data.field , data ,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
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
