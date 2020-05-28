import Vue from 'vue'
import App from './App.vue'
let bootstrap = require('bootstrap');
import './assets/app.css';
import router from './router'
import { store } from './store';
import axios from 'axios';
import jwtToken from './helpers/jwt-token';
window.axios = axios;
window.jQuery = require('jquery');
import VueNoty from 'vuejs-noty'
// import VueSkeletonLoading from 'vue-skeleton-loading';

import Skeleton from 'vue-loading-skeleton';
axios.interceptors.request.use(config => {

  //NProgress.start();

  //config.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
  config.headers['X-Requested-With'] = 'XMLHttpRequest';
  config.headers['Access-Control-Allow-Origin'] = '*';
  if (jwtToken.getToken()) {
      config.headers['Authorization'] = 'Bearer ' + jwtToken.getToken();
  }
  return config;
}, error => {
  return Promise.reject(error);
});

axios.interceptors.response.use(response => {
  //NProgress.done();
  return response;
}, error => {

 // NProgress.done();
  let errorResponseData = error.response.data;
  const errors = ["token_invalid", "token_expired", "token_not_provided"];

  if (errorResponseData.error && errors.includes(errorResponseData.error)) {
    store.dispatch('unsetAuthUser')
      .then(() => {
        jwtToken.removeToken();
        router.push({name: 'login'});
      });
  }

  return Promise.reject(error);
});






Vue.use(VueNoty, {
  progressBar: false,
  layout: 'topRight',
  theme: 'bootstrap-v4',
  timeout: 3000
})
Vue.use(bootstrap)
Vue.config.productionTip = false
Vue.use(Skeleton);
new Vue({
  
  store,
  router,
  render: h => h(App)
}).$mount('#app')
