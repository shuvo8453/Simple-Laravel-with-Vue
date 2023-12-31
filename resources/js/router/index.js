import {createRouter, createWebHistory} from 'vue-router';
import Home from '../components/Home.vue'
import About from '../components/About.vue'
import SliderCreate from "@/views/slider/Create.vue";
import SliderIndex from "@/views/slider/Index.vue";
import SliderUpdate from "@/views/slider/UpdateForm.vue";
import Login from "@/views/Login.vue";
import Registration from "@/views/Registration.vue";

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
    },
    {
        path: '/registration',
        name: 'registration',
        component: Registration
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

router.beforeEach((to, from, next) => {
    // Placeholder for the user's authentication status
    const isAuthenticated = localStorage.getItem('token');
    const excludeRoutes = ['login', 'registration'];

    if (!excludeRoutes.includes(to.name) && !isAuthenticated) next({ name: 'login' })
    else next()
})

export default router;
