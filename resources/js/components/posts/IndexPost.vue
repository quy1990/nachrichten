<template>
    <div>
        <h2 class="text-center">Posts Manager</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Body</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.body }}</td>
                <td>{{ post.author.user_name }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editPost', params: { id: post.id }}" class="btn btn-success">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteProduct(post.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: []
        }
    },
    created() {
        this.axios
            .get('/api/posts')
            .then(response => {
                this.posts = response.data.data;
            });
    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`/api/posts/${id}`)
                .then(response => {
                    let i = this.posts.map(data => data.id).indexOf(id);
                    this.posts.splice(i, 1)
                });
        }
    }
}
</script>
