<template>

 <div class="d-flex" id="wrapper" :class="{'toggled' : isToggle}">
   <side-bar></side-bar>
  <div id="page-content-wrapper">
    <nav-bar></nav-bar>
  
    <div class="container-fluid">
      <!-- <transition
        name="fade"
        mode="out-in"
        @beforeLeave="beforeLeave"
       @enter="enter"
       @afterEnter="afterEnter"
      > -->
        <router-view/>
      <!-- </transition> -->
    </div>
   </div>
 </div>
</template>

<script>
import SideBar from './components/SideBar'
import NavBar from './components/NavBar'

export default {
  name: 'App',
  data() {
    return {
     
    }
  },
  components: {
   SideBar,
   NavBar
  },
  computed:{
      isToggle() {
        return this.$store.getters.toggleMenuGetter;
      }
  },
  methods:{
    beforeLeave(element) {
      this.prevHeight = getComputedStyle(element).height;
    },
    enter(element) {
      const { height } = getComputedStyle(element);

      element.style.height = this.prevHeight;

      setTimeout(() => {
        element.style.height = height;
      });
    },
    afterEnter(element) {
      element.style.height = 'auto';
    },
  }
}
</script>
