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
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders">
                <th scope="row">{{ order.id }}</th>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.customer_email }}</td>
                <td>{{ order.customer_mobile }}</td>
                <td>{{ order.product?.name }}</td>
                <td>{{ formatStatus(order.status) }}</td>
                <td>
                    <button class="btn btn-secondary rounded-0 fw-bold" @click="openModal(order)">Ver pedido</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div v-else class="text-center">
            Cargando...
        </div>
        <request-modal :logged="$store.state.token != ''" :order-selected="orderSelected" :show-modal="modal"
                       @closeModal="modal = false"></request-modal>
    </div>
</template>

<script>
import axios from "axios";
import RequestModal from "./modals/Request.vue";
import router from "../router/index";
import {formatStatus} from "../helpers/helper";

export default {
    name: "Order",
    components: {
        RequestModal
    },
    data: () => ({
        loading: false,
        orders: [],
        orderSelected: {},
        modal: false
    }),
    mounted() {
        if (this.$store.state.token === '') router.push('/')
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
        formatStatus,
        openModal(orderSelected) {
            this.modal = true
            this.orderSelected = orderSelected
        }
    }
}
</script>

<style scoped>

</style>
