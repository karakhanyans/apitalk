import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import {routes} from './routes'
import store from './store/store'
import firebase from 'firebase'

const config = {
    apiKey: "AIzaSyAmdUsnhxvXotLbSi1Hn6i0s7u5Ppc-EFA",
    authDomain: "apitalk.firebaseapp.com",
    databaseURL: "https://apitalk.firebaseio.com",
    projectId: "apitalk",
    storageBucket: "",
    messagingSenderId: "691513576838"
};
firebase.initializeApp(config);
let app = "";
Vue.use(VueRouter);
const router = new VueRouter({
    routes
});
router.beforeEach((to, from, next) => {
    const currentUser = firebase.auth().currentUser;
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    if (requiresAuth && !currentUser) next('/auth/signin');
    else next();
});
firebase.auth().onAuthStateChanged(() => {
    if (!app) {
        app = new Vue({
            el: '#app',
            router,
            store, // inject store to all children
            render: h => h(App)
        });

    }
});
