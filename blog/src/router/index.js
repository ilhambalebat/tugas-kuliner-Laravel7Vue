import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/auth/Login.vue'
import store from '../store'
import New from '../views/posts/New.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'auth.login',
    // component: () => import(/* webpackChunkName: "login" */ '../views/auth/Login.vue')
    component: Login
  },
  {
    path: '/posts/new',
    name: 'posts.new',
    component: New,
    meta: {
      auth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  linkActiveClass: 'active',
  routes
})

router.beforeEach((to, from, next) => {
  if(to.meta.auth && !store.getters['auth/check']) next('/login')
  else next()

  if(to.name == 'auth.login' && store.getters['auth/check']) next({name: 'Home'})
  else next()
})

export default router
