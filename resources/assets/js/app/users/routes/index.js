import {Users} from '../components'

export default [
    {
        path: '/users',
        component: Users,
        name: 'users',
        meta: {
            guest: false,
            needsAuth: true
        }
    }
]