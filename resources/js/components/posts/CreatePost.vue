<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input v-model="product.name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input v-model="product.detail" class="form-control" type="text">
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: {}
        }
    },
    methods: {
        addProduct() {
            this.axios
                .post('http://localhost:8000/api/products', this.product)
                .then(response => (
                    this.$router.push({name: 'home'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>
