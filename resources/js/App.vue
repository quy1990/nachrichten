<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link" to="/posts">Posts</router-link>
                    <router-link class="nav-item nav-link" to="/posts/create">Create Post</router-link>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script>
export default {}
</script>
