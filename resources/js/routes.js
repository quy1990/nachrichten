import Index from './components/posts/IndexPost.vue';
import CreatePost from './components/posts/CreatePost.vue';
import EditPost from './components/posts/EditPost.vue';

export const routes = [
    {
        name: 'home',
        path: '/posts',
        component: Index
    },
    {
        name: 'create',
        path: '/posts/create',
        component: CreatePost
    },
    {
        name: 'edit',
        path: '/posts/edit/:id',
        component: EditPost
    }
];
