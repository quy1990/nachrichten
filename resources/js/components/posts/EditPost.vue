<template>
    <div>
        <h3 class="text-center">Edit post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Title</label>
                        <input v-model="post.title" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea v-model="post.body" class="form-control" type="text"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button class="btn btn-info" type="submit">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {}
        }
    },
    created() {
        this.axios
            .get(`/api/posts/${this.$route.params.id}`)
            .then((res) => {
                this.post = res.data.data;
            });
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`/api/posts/${this.$route.params.id}`, this.post)
                .then((res) => {
                    this.$router.push({name: 'home'});
                });
        }
    }
}
</script>
