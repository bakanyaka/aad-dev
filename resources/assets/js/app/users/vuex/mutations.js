export const setUsers = (state, users) => {
    state.users = users;
};

export const setFoundUsers = (state, foundUsers) => {
    state.foundUsers = foundUsers
};

export const setUserDetails = (state, user) => {
    state.userDetails = user
};

export const setLoadingUserDetails = (state, trueOrFalse) => {
    state.loadingUserDetails = trueOrFalse
};