<template>
    

    <div class="row text-center">
        <post-card v-for="item in items" :key="item.id" :item="item"></post-card>
    </div>

</template>
<script>

import { API } from '../config';
import PostCard from '../components/PostCard';
export default {

   props:['owner'],
   data() {
       return {
           items:[]
       }
   },
   components:{
       PostCard
   },
   methods:{

       async posts() {
            try {
                const response = await axios.get(API.posts,{ params:{ id:this.owner }});
                this.items = response.data;
            }catch( err ) {
               
            }

      },
   },
   mounted() {
       this.posts();
   }
}
</script>