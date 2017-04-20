import auth from './auth/routes'
import home from './home/routes'
import users from './users/routes'
import errors from './errors/routes'

export default [
    {
        path: '/',
        component: {template: '<app></app>'},
        children: [...home, ...users]
    },
    ...auth,
    ...errors
]