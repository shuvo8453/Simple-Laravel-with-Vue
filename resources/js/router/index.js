import {createRouter, createWebHistory} from 'vue-router';
import Home from '../components/Home.vue'
import About from '../components/About.vue'
import SliderCreate from "@/views/slider/Create.vue";

const routes = [
    {
        path:'/',
        name:'home',
        component:Home
    },
    {
        path:'/about',
        name:'about',
        component:About
    },
    {
        path:'/admin/slider',
        name:'slider.create',
        component:SliderCreate
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;