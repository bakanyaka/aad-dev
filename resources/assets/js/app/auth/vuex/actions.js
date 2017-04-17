export const login = ({dispatch}, {payload, context}) => {
    return axios.post('/api/login', payload).then((response) => {
        console.log(response)
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};