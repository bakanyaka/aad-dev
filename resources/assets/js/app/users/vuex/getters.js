import {sortBy} from 'lodash'

export const allUsers = (state) => {
    return state.users
};

export const loadingUsers = (state) => {
    return state.loadingUsers
};


export const foundUsers = (state) => {
    return sortBy(state.foundUsers, ['lastName', 'firstName'])
};


export const userDetails = (state) => {
    return state.userDetails
};

export const loadingUserDetails = (state) => {
    return state.loadingUserDetails
};