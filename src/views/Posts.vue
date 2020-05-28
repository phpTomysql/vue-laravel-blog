<template>
  <div>
   <h1>My Posts</h1>
    <post-list :owner="userId"></post-list>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
import PostList from '../components/PostList';
export default {
  components:{
    PostList
  },
  computed:{
     ...mapGetters([
            'userId',
            ]),
    },
}
</script>