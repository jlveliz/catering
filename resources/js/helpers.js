
'use strict';

import axios from 'axios';

export const Helpers = {

    setBodyTheme(theme) {
        const body = document.querySelector('body');
        body.setAttribute('themebg-pattern', theme);
    },

    removeBodyTheme() {
        const body = document.querySelector('body');
        body.removeAttribute('themebg-pattern');
    },

    async validateUnique(data) {
        let promise = await axios.post('/api/validators', data, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } });
        return await promise.data;
    }



}
