
'use strict';

export const Helpers = {

    setBodyTheme(theme) {
        const body = document.querySelector('body');
        body.setAttribute('themebg-pattern', theme);
    },

    removeBodyTheme() {
        const body = document.querySelector('body');
        body.removeAttribute('themebg-pattern');
    }



}
