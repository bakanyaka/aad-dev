import {setHttpToken} from "../../../helpers/index";

export const login = ({dispatch}, {payload, context}) => {
    return axios.post('/api/login', payload).then((response) => {
        dispatch('setToken', response.data.meta.token).then(() => {
            console.log('Fetch user')
        })
    }).catch((error) => {
        context.errors = error.response.data.errors;
    })
};

export const setToken = ({commit, dispatch}, token) => {
    commit('setToken', token);
    setHttpToken(token)
};