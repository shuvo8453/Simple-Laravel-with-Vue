import {createRouter, createWebHistory} from 'vue-router';
import Home from '../components/Home.vue'
import About from '../components/About.vue'
import SliderCreate from "@/views/slider/Create.vue";
import SliderIndex from "@/views/slider/Index.vue";
import SliderUpdate from "@/views/slider/UpdateForm.vue";
import Login from "@/views/Login.vue";

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
        name:'slider.index',
        component:SliderIndex,
        meta: { requiresAuth:true }
    },
    {
      path: '/admin/slider/update/:id',
      name: 'slider.updateform',
      component:   SliderUpdate
    },
    {
        path: '/admin/slider/create',
        name: 'slider.create',
        component: SliderCreate
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
