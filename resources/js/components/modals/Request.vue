<template>
    <div v-if="showModal" class="--custom-modal bg-white">
        <div class="text-end --custom-modal-cursor-pointer" @click="$emit('closeModal')">
            <small>Close Modal</small>
        </div>
        <div v-if="logged">
            <div class="text-center">
                <h4>Resumo do pedido</h4>
                <p>
                <div>Customer Name</div>
                {{ orderSelected.customer_name }}
                </p>
                <p>
                <div>Product</div>
                {{ orderSelected.product.name }}
                </p>
                <p>
                <div>Status</div>
                {{ formatStatus(orderSelected.status) }}
                </p>
                <p>
                <div>URL de Pagamento</div>
                <a v-if="orderSelected.status !== 'PAYED'" :href="orderSelected.url"
                   target="_blank">{{ orderSelected.url }}</a>
                </p>
            </div>
        </div>
        <div v-else class="text-center mt-5 fw-bold">
            Login necessário
        </div>
    </div>
</template>

<script>
import {formatStatus} from "../../helpers/helper";

export default {
    name: "Request",
    props: {
        showModal: Boolean,
        orderSelected: Object,
        logged: Boolean
    },
    methods: {
        formatStatus
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

