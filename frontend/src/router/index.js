import {createRouter, createWebHistory} from 'vue-router';
import HomeView from '../views/HomeView.vue';
import MissionControlView from '../views/MissionControlView.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/mission',
        name: 'mission-control',
        component: MissionControlView
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;