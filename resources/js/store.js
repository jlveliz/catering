'use strict';

import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        layout: 'simple-layout',
        token: localStorage.getItem('token') || null,
        user: {}
    },
    mutations: {
        SET_LAYOUT(state, payload) {
            state.layout = payload;
        },
        RETRIEVETOKEN(state, token) {
            state.token = token;
        },
        DESTROYTOKEN(state) {
            state.token = null
        },
        SET_USER(state,user) {
            state.user = user
        },
        REMOVE_USER(state) {
            state.user = null
        }
    },
    getters: {
        layout(state) {
            return state.layout;
        },
        loggedIn(state) {
            return state.token !== null
        },
        getUser(state) {
            return state.user;
        }
    },
    actions: {
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/api/login', {
                    email: credentials.email,
                    password: credentials.password,
                    remember: credentials.remember
                })
                    .then(response => {
                        //console.log(response)
                        const token = response.data.success.token
                        localStorage.setItem('token', token)
                        context.commit('RETRIEVETOKEN', token)
                        resolve(response)
                    })
                    .catch(error => {
                        //console.log(error)
                        reject(error)
                    })
            })

        },
        getUser(context) {
            if (context.getters.loggedIn) {
                return new Promise( (resolve, reject)  => {
                    axios.post('/api/user-info','',{
                        headers: { Authorization: "Bearer " + context.state.token }
                    }).then( response => {
                        context.commit('SET_USER',response.data.data)
                        resolve(response.data);
                    })
                })
            }
        },
        destroyToken(context) {
            if (context.getters.loggedIn) {

                return new Promise((resolve, reject) => {
                    axios.post('/api/logout', '', {
                        headers: { Authorization: "Bearer " + context.state.token }
                    })
                        .then(response => {
                            //console.log(response)
                            localStorage.removeItem('token')
                            context.commit('DESTROYTOKEN')
                            context.commit('REMOVE_USER')

                            resolve(response)
                        })
                        .catch(error => {
                            //console.log(error)
                            localStorage.removeItem('token')
                            context.commit('DESTROYTOKEN')
                            context.commit('REMOVE_USER')
                            reject(error)
                        })
                })

            }
        }
    }
})
