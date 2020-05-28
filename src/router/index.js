import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Posts from '../views/Posts.vue'
import jwtToken from '../helpers/jwt-token';
import { API } from '../config'
import { store } from '../store';
Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    meta:{
      requiresGuest:true
    },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/register',
    name: 'Register',
    meta:{
      requiresGuest:true
    },
    component: () => import(/* webpackChunkName: "register" */ '../views/Register.vue')
  },
  {
    path: '/myposts',
    name: 'Posts',
    meta: {
      requiresAuth: true
    },
    component: () => import('../views/Posts.vue')
  },
  {
    path: '/login',
    name: 'Login',
    meta:{
      requiresGuest:true
    },
    component: () => import('../views/Login.vue')
  },
  {
    path: '/profile',
    name: 'Profile',
    meta: {
      requiresAuth: true
    },
    component: () => import('../views/Profile.vue')
  },
  {
    path: '/addpost',
    name: 'AddPost',
    meta: {
      requiresAuth: true
    },
    component: () => import('../views/AddPost.vue')
  },
  {
    path: '/:uname/:slug',
    name: 'Post',
    meta: {
      
    },
    component: () => import('../views/Post.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})



router.beforeEach(async (to, from, next) => {

	// just logged in: localStorage has token, but state does not have auth user
	if (jwtToken.getToken() && !store.getters.isLoggedIn) {

		await axios.get(API.currentUser).then(res => {
        let {data : authUser } = res.data
		     store.dispatch('setAuthUser', authUser );
		
		})
		.catch(err => {
			jwtToken.removeToken()
		}); 
	}

	if (to.meta.requiresAuth) {
		if (store.getters.isLoggedIn || jwtToken.getToken()) {
			return next();
		} else {
			return next({name: 'Login'});
		}
	}
	if (to.meta.requiresGuest) {
		if (store.getters.isLoggedIn || jwtToken.getToken())
			return next({name: 'Home'});
		else
			return next();
	}
	next();
});

export default router
