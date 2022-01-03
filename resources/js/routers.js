import Index from "./components/Index.vue";
import UserDashboard from "./components/UserDashboard.vue";
import { createRouter, createWebHistory } from "vue-router";
const routes =[
{
    name: "Index",
        component: Index,
    path: "/",
},
{
    name: "UserDashboard",
        component: UserDashboard,
    path: "/user-dashboard",
},
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
