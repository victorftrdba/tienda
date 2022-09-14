<template>
    <div class="--custom-modal bg-white" v-if="showModal">
        <div class="text-end --custom-modal-cursor-pointer" @click="$emit('closeModal')">
            <small>Close Modal</small>
        </div>
        <div v-if="logged">
            <div class="text-center" v-if="step === 0">
                <h4>Producto selecionado: {{ productSelected.name }}</h4>
                <div class="px-5 mb-3">
                    <label for="customer_email">Customer Name</label>
                    <input class="form-control" type="text" v-model="customer_name">
                </div>
                <div class="px-5 mb-3">
                    <label for="customer_email">Customer E-mail</label>
                    <input class="form-control" type="text" v-model="customer_email">
                </div>
                <div class="px-5 mb-3">
                    <label for="customer_email">Customer Mobile</label>
                    <input class="form-control" type="text" v-model="customer_mobile">
                </div>
                <div class="text-end pe-5 mt-3">
                    <button class="btn btn-primary rounded-0" @click="step = 1">Avançar</button>
                </div>
            </div>
            <div class="text-center" v-if="step === 1">
                <h4>Resumo do pedido</h4>
                <p>
                <div>Producto</div>
                {{productSelected.name}}
                </p>
                <p>
                <div>Preço</div>
                ${{productSelected.price}}
                </p>
                <p>
                <div>Nombre</div>
                {{customer_name}}
                </p>
                <p>
                <div>E-mail</div>
                {{ customer_email }}
                </p>
                <p>
                <div>Teléfono</div>
                {{ customer_mobile }}
                </p>
                <div class="text-end pe-5 mt-3">
                    <button class="btn btn-dark rounded-0 fw-bold" @click="step = 0">Voltar</button>
                    <button class="btn btn-dark rounded-0 ms-2 fw-bold" @click="submitOrder()">Submit</button>
                </div>
            </div>
            <div v-if="step === 2" class="text-center">
                <div>Pedido realizado!</div>
                <small>Acesse o link para realizar o pagamento: <a :href="paymentUrl"
                                                                   target="_blank">{{ paymentUrl }}</a></small>
                <div>
                    <button class="btn btn-primary rounded-0 fw-bold" @click="goToOrders()">Ir para meus pedidos
                    </button>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 fw-bold" v-else>
            Login necessário
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router/index.js";

export default {
    name: "Order",
    props: {
        showModal: Boolean,
        productSelected: Object,
        logged: Boolean
    },
    data: () => ({
        customer_name: '',
        customer_email: '',
        customer_mobile: '',
        step: 0,
        paymentUrl: ''
    }),
    methods: {
        submitOrder () {
            const token = localStorage.getItem('jwt')
            const payload = {
                customer_name: this.customer_name,
                customer_email: this.customer_email,
                customer_mobile: this.customer_mobile,
                product_id: this.productSelected.id
            }
            axios.post('http://localhost:8000/api/orders', payload, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }).then(res => {
                this.step = 2
                this.paymentUrl = res.data.url
            }).catch(err => {
                console.log(err)
            })
        },
        goToOrders() {
            router.push('/orders')
        }
    }
}
</script>

<style scoped>
    .--custom-modal {
        position: absolute;
        width: 50%;
        height: 80%;
        overflow-y: scroll;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 10px 10px 10px 10px black;
        color: black;
    }
    .--custom-modal-cursor-pointer {
        cursor: pointer;
    }
</style>
