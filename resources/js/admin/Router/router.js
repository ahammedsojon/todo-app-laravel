import {createRouter, createWebHistory} from "vue-router";


//=====================
// Pages
//=====================
import Layout from '../Pages/Layout/Layout.vue'
import Todos from '../Pages/Todos/Todos.vue'



const ROOT_URL = "/admin";
const routes = [

    // Dashboard Panel Layout
    {
        path: ROOT_URL, name: 'Layout', component: Layout,
        children: [
            {
                path: ROOT_URL  + '/', name: 'Todos', component: Todos
            }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
