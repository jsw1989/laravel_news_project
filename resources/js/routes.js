import AllNews from './components/AllNews.vue';
import EditNews from './components/EditNews.vue';
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllNews
    },
    {
        name: 'edit',
        path: '/edit/:id?',
        component: EditNews
    }
];
