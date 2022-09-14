import {createRouter, createWebHistory} from "vue-router";
import Home from "../components/Home.vue";
import Tienda from "../components/Tienda.vue";
import Order from "../components/Order.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/tienda',
        name: 'tienda',
        component: Tienda
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },{
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/user',
        name: 'user',
        beforeEnter: (to, from, next) => {
            if (!localStorage.getItem('jwt')) next('/')
            else next()
        },
        children: [
            {
                path: '/orders',
                name: 'orders',
                component: Order
            }
        ]
    }

];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
