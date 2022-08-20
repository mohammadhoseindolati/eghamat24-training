<template>
  <router-link class="mr-1" to="/">Home</router-link>
  <router-link class="mr-1" to="/new">Add new Todo </router-link>

  <router-view></router-view>
</template>

<script>

export default {
    components : {
    } ,
    data(){
      return {
      }
    } ,
    methods : {
      showData(event){
        this.name = event 
      }
    }
}
</script>

<style>
.mr-1 {
  margin-right: 1rem;
}
</style>
