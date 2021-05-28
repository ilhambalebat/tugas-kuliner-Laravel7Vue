import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/auth/Login.vue'
import New from '../views/posts/New.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/posts',
    name: 'posts.index',
    component: () => import(/* webpackChunkName: "post index" */ '../views/posts/Index.vue')
  },
  {
    path: '/posts/:subjectSlug/:postSlug',
    name: 'posts.show',
    component: () => import(/* webpackChunkName: "post index" */ '../views/posts/Show.vue')
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
  if(to.meta.auth == true && store.getters['auth/check'] == false) next({name: 'auth.login'})
  else next()

  // if(to.name == 'auth.login' && store.getters['auth/check']) next({ name: 'home' })
  // else next()

  // if(to.name == 'auth.login' && store.getters['auth/check'] == true) next({name: 'Home'})
  // else next()

  // if(to.name == 'Home' && store.getters['auth/check'] == false) next({name: 'auth.login'})
  // else next()

 
  console.log(from)
  console.log(next)
  console.log(to)
  console.log(store.getters['auth/check'])

})

export default router
