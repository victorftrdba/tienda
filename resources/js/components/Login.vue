<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">Login</h2>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <label for="email">E-mail</label>
                <input type="email" v-model="email" class="form-control">
            </div>
            <div class="col-6 mb-5">
                <label for="password">Senha</label>
                <input type="password" v-model="password" class="form-control">
            </div>
            <button class="btn btn-secondary rounded-0 fw-bold" @click="auth()" :disabled="sending">Logar</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../router/index.js";

export default {
    name: "Login",
    data: () => ({
        email: '',
        password: '',
        sending: false
    }),
    methods: {
        auth () {
            this.sending = true
            const payload = {
                email: this.email,
                password: this.password
            }
            axios.post('http://localhost:8000/api/auth', payload).then(res => {
                const token = res.data.token
                localStorage.setItem('jwt', token)
                axios.get('http://localhost:8000/api/user', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }).then(res => {
                    this.$store.commit('setUser', {
                        user: res.data,
                        token: token
                    })
                })
            }).catch(err => {
                console.log(err)
            }).finally(() => {
                this.sending = false
                router.push('/')
            })
        }
    }
}
</script>

<style scoped>

</style>
