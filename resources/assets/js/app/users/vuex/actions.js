import {filter, sortBy} from 'lodash'
export const fetchUsers = ({commit}) => {
    return axios.get('/api/users').then((response) => {
        commit('setUsers', response.data.data);
    });
};

export const filterUsers = ({commit, state}, searchString) => {
    let filteredUsers = filter(state.users, (user) => {
        for (let property in user) {
            if (typeof user[property] === "string" && user[property].toLowerCase().includes(searchString.toLowerCase()) ) {
                return true
            }
        }
        return false
    });
    commit('setFilteredUsers', sortBy(filteredUsers, ['lastName', 'firstName']));
};

export const fetchUserDetails = ({commit}, user) => {
    commit('setLoadingUserDetails', true);
    setTimeout(() => {
        commit('setUserDetails', user);
        commit('setLoadingUserDetails', false);
    }, 500);
};