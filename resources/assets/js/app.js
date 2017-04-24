import Vue from 'vue'
import router from './router'
import store from './vuex'
import localforage from 'localforage'

localforage.config({
    driver: localforage.LOCALSTORAGE,
    storeName: 'aad'
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


if (typeof NODE_ENV === 'undefined' || NODE_ENV === "production") {
    require('./dev')
}


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', require('./components/App.vue'));
Vue.component('navbar-top', require('./components/NavbarTop.vue'));
Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('app-footer', require('./components/Footer.vue'));

store.dispatch('auth/setToken').then(() => {
    store.dispatch('auth/fetchUser').catch(() => {
        store.dispatch('auth/clearAuth');
        router.replace({name: 'login'});
    });
}).catch(() => {
    store.dispatch('auth/clearAuth');
    router.replace({name: 'login'});
});

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
