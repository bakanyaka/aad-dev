import {isEmpty} from "lodash";

export const setHttpToken = (token) => {
    window.axios.defaults.headers.common['Authorization'] = isEmpty(token) ? null : 'Bearer ' + token
};
