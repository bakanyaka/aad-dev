import localforage from 'localforage'

export const setToken = (state, token) => {
    localforage.setItem('authtoken', token)
};