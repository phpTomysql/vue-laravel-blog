<template>
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Vue Blog </div>
      <div class="list-group list-group-flush">
         <router-link to="/" class="list-group-item list-group-item-action bg-light">Home</router-link>
         <router-link to="/profile" class="list-group-item list-group-item-action bg-light" v-if="isLoggedIn">Profile</router-link>
         <router-link to="/myposts" class="list-group-item list-group-item-action bg-light" v-if="isLoggedIn">My Posts</router-link>
         <router-link to="/register" class="list-group-item list-group-item-action bg-light" v-if="!isLoggedIn">Register</router-link>
         <router-link to="/login" class="list-group-item list-group-item-action bg-light" v-if="!isLoggedIn">Login</router-link>
         <router-link to="/addpost" class="list-group-item list-group-item-action bg-light" v-if="isLoggedIn">Add Post</router-link>
          <a href="javascript:;" class="list-group-item list-group-item-action bg-light" v-if="isLoggedIn" @click="logout">Logout</a>
      </div>
      
    </div>
    <!-- /#sidebar-wrapper -->
</template>
<script>

import {mapGetters} from 'vuex';
import { API } from '../config';
import jwtToken from '../helpers/jwt-token'

export default {

  computed:{
     ...mapGetters([
            'isLoggedIn',
            ]),
  },
  methods:{
            logout() {
                

                 axios.post(API.logout)
                    .then(res => {
                         jwtToken.removeToken();
                        this.$store.dispatch('unsetAuthUser')
                        .then(() => {
                        this.$noty.success('You have logged out successfully');
                        this.$router.push({name: 'Login'});
                        });
                    })
                    .catch(err => {
                       this.$router.push({name: 'Login'});
                    });
                    
                
            }
  }
  
}
</script>