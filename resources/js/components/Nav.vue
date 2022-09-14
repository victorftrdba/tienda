<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <router-link class="text-reset text-decoration-none" to="/">
                    Bienvenido
                </router-link>
                <router-link class="text-reset text-decoration-none ms-3" to="/tienda">
                    Tienda
                </router-link>
                <router-link class="text-reset text-decoration-none ms-3" to="/orders" v-if="$store.state.token">
                    Mis Pedidos
                </router-link>
                <div class="mt-3" v-if="!$store.state.token">
                    <router-link class="text-reset text-decoration-none ms-3" to="/login">
                        Login
                    </router-link>
                    <router-link class="text-reset text-decoration-none ms-3" to="/register">
                        Register
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Nav"
}
</script>

