<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="fw-bold">Registro</h2>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <label for="name">Nome</label>
                <input type="text" v-model="name" class="form-control">
            </div>
            <div class="col-6">
                <label for="email">E-mail</label>
                <input type="email" v-model="email" class="form-control">
            </div>
            <div class="col-6 mb-5">
                <label for="password">Senha</label>
                <input type="password" v-model="password" class="form-control">
            </div>
            <button class="btn btn-secondary rounded-0 fw-bold" @click="register()" :disabled="sending">Registrar</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../router/index.js";

export default {
    name: "Register",
    data: () => ({
        name: '',
        email: '',
        password: '',
        sending: false
    }),
    methods: {
        register () {
            this.sending = true
            const payload = {
                name: this.name,
                email: this.email,
                password: this.password
            }
            axios.post('http://localhost:8000/api/register', payload).then(res => {
                console.log(res)
                router.push('/login')
            }).catch(err => {
                console.log(err)
            }).finally(() => {
                this.sending = false
            })
        }
    }
}
</script>

<style scoped>

</style>
