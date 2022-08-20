import { createRouter ,createWebHistory } from 'vue-router'
import newTodo from './components/NewTodo.vue'
import ShowTodos from './components/ShowTodos.vue'

const routes = [
    { path: '/new', component: newTodo },
    { path: '/', component: ShowTodos },
  ]
  

const router = createRouter({
    history : createWebHistory() ,
    routes 
})

export default router 