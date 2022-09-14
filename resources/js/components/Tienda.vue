<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h2 class="fw-bold">Productos</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 text-dark text-center" v-for="product in products">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <p>Preço: ${{ product.price }}</p>
                        <a href="#" class="btn btn-dark rounded-0 fw-bold text-uppercase" @click="openModal(product)"><small>Comprar</small></a>
                    </div>
                </div>
            </div>
        </div>
        <order-modal :logged="$store.state.token != ''" :product-selected="productSelected" :show-modal="modal"
                     @closeModal="modal = false"></order-modal>
    </div>
</template>

<script>
import axios from "axios";
import OrderModal from "./modals/Order.vue";

export default {
    name: "Tienda",
    components: {
        OrderModal
    },
    data: () => ({
        products: [],
        productSelected: {},
        modal: false
    }),
    methods: {
        openModal (data) {
            this.modal = true
            this.productSelected = data;
        }
    },
    mounted () {
        axios.get('http://localhost:8000/api/products')
            .then(res => {
                this.products = res.data.data
            })
    }
}
</script>

<style scoped>

</style>
