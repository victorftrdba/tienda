<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h2 class="fw-bold">Mis Pedidos</h2>
            </div>
        </div>
        <table class="table text-white text-center" v-if="!loading">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer E-mail</th>
                <th scope="col">Customer Mobile</th>
                <th scope="col">Product</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders">
                <th scope="row">{{ order.id }}</th>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.customer_email }}</td>
                <td>{{ order.customer_mobile }}</td>
                <td>{{ order.product?.name }}</td>
                <td>{{formatStatus(order.status)}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Order",
    data: () => ({
        loading: false,
        orders: []
    }),
    mounted () {
        this.loading = true
        const token = localStorage.getItem('jwt')
        axios.get('http://localhost:8000/api/my-orders', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        }).then(res => {
            this.orders = res.data
        }).finally(() => {
            this.loading = false
        })
    },
    methods: {
        formatStatus (value) {
            switch (value) {
                case 'APPROVED':
                    return 'APROVADO'
                case 'REJECTED':
                    return 'REJEITADO'
                case 'CREATED':
                    return 'CRIADO'
            }
        }
    }
}
</script>

<style scoped>

</style>
