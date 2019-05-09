import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Login from './views/Login.vue'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            // Check if user have token, else redirect to login
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('token')) {
                    next()
                } else {
                    return next('login' );
                }
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        }
    ]
})
