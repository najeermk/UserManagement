import { creareRouter, createWebHistory} from 'vue-router'

import Home from './components/Home.vue'
import List from './components/users/List.vue'             
import Add from './components/users/Add.vue'
import Edit from './components/users/Edit.vue'

    const routes = [
        {
            name: 'Home',
            path: '/',
            component: Home
        },
        {
            name: 'List',
            path: '/users',
            component: List
        },
        {
            name: 'Edit',
            path: '/users/:id/edit',
            component: Edit
        },
        {
            name: 'Add',
            path: '/users/store',
            component: Add
        }
    ]

    const router = creareRouter({
        history: createWebHistory(),
        routes
    })

    export default router