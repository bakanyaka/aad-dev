import {Home} from '../components';

export default [
    {
        path: '/',
        redirect: {name: 'users'},
        component: Home,
        name: 'home',
        meta: {
            guest: false,
            needsAuth: true
        }
    }
]