<template>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" :src="item.image_thumbnail" :alt="item.subtitle">
          <div class="card-body">
            <h4 class="card-title">{{item.title}}</h4>
            <p class="card-text">{{item.meta_desc}}</p>
          </div>
          <div class="card-footer">
             <router-link class="btn btn-primary" :to="{ name : 'Post' , params: { 'uname': item.user.name ,'slug':item.slug }}">Find Out More!</router-link>
          </div>
        </div>
      </div>
</template>
<script>

export default {
  components:{

  },
    props:{
        item:Object
    },
   data() {
       return {
           
       }
   },
   methods:{

      
   },
   mounted() {
      
   }
}
</script>