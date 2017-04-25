import {filter, sortBy} from 'lodash'
export const fetchUsers = ({commit}) => {
    return axios.get('/api/users').then((response) => {
        commit('setUsers', response.data.data);
    });
};

export const findUsers = ({commit, dispatch, state}, searchString) => {
    let found = searchString.match(/[a-z]+\d*-\d+/i);
    if (found) {
        return dispatch('findUserByComputer', searchString);
    }
    let filteredUsers = filter(state.users, (user) => {
        for (let property in user) {
            if (typeof user[property] === "string" && user[property].toLowerCase().includes(searchString.toLowerCase()) ) {
                return true
            }
        }
        return false
    });
    commit('setFoundUsers', filteredUsers);
};

export const findUserByComputer = ({commit}, computerName) => {
    return axios.get(`/api/users/search?q=${computerName}`).then((response) => {
        commit('setFoundUsers', response.data.data);
    });
};

export const fetchUserDetails = ({commit}, user) => {
    commit('setLoadingUserDetails', true);
    setTimeout(() => {
        commit('setUserDetails', user);
        commit('setLoadingUserDetails', false);
    }, 500);
};

