<template>
        <div>
        <comment v-for="comment in comments" :key="comment.id" :comment="comment"></comment>
        </div>
</template>
<script>
    
    export default{
        components:{
            comment:()=> import('./Comment')
        },
        props: ['comments']
    }
</script>