<template>
     <div>
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-12">

        <!-- Title -->
        <h1 class="mt-4">{{ content.title }}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{ content.user.name }}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on January 1, 2019 at 12:00 PM</p>

        <hr>

        <!-- Preview Image -->
         <header class="masthead" v-bind:style="{ 'background-image': 'url(' + content.image_large + ')' }">
  <!-- <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        <h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
        <p class="lead">A great starter layout for a landing page</p>
      </div>
    </div>
  </div> -->
</header>
        <hr>

        <!-- Post Content -->
         <div v-html="content.post_body"></div>
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form @submit.prevent="comment"> 
              <div class="form-group">
                <textarea class="form-control" rows="3" v-model="reply"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" v-if="isLoggedIn">Submit</button>
              <button type="button" @click="forceLogin" class="btn btn-primary" v-else>Login</button>
            </form>
          </div>
        </div>

        <CommentList :comments="content.comments"></CommentList>
        <!-- Single Comment -->
        <!-- <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div> -->

        <!-- Comment with nested comments -->
        <!-- <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div> -->

      </div>
    </div></div>
 
  <!-- Footer -->
  <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
  </footer>
  
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
import { API } from '../config';
import CommentList from '../components/CommentList';

export default {

  components:{
    CommentList
  },
    data() {
        return {
            content:{
              user:{
                name:''
              },
              comments:[]
            },
            reply:''
        }
    },
    computed:{
     ...mapGetters([
            'isLoggedIn',
            ]),
    },
    methods:{
      forceLogin() {
          this.$router.push({ path: '/login' })
      },

        async comment() {

        try{
         const  response = await axios.post(API.comment, {content: this.reply, post_id: this.content.id});
         this.post();
         this.reply = '';
        } catch( err ) {

        }
         

        },
        async post() {

         try{
           const response = await axios.get(API.post, 
                        { params : 
                            { 
                                username: this.$route.params.uname , slug:this.$route.params.slug
                            }
                        });
            this.content = response.data.post;
            
         }catch( err ) {

         }
        }
    },
    mounted() {

        this.post();

    }
    
}
</script>