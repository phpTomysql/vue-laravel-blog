<template>

  <div>
  <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">A Warm Welcome!</h1>
      <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
      <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <!-- Page Features -->
    

      <post-list></post-list>

    
    <!-- /.row -->

  
 
  <!-- Footer -->
  <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
  </footer>
  
  </div>
</template>

<script>

import PostList from '../components/PostList';

export default {
  name: 'Home',
  data() {
    return {
     
    }
  },
  components: {
   PostList
  },
  mounted() {
  
    
  }
}
</script>
