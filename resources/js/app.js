import './bootstrap';
import { createApp } from 'vue';
import router from "./router/index";
import App from "./App.vue";
import 'bootstrap/dist/js/bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import {createStore} from "vuex";

const app = createApp({});

const store = createStore({
    state () {
        return {
            user: {},
            token: ''
        }
    },
    mutations: {
        setUser (state, payload) {
            state.user = payload.user
            state.token = payload.token
        }
    }
})

app.component('app', App);
app.use(router);
app.use(store);
app.mount('#app');
