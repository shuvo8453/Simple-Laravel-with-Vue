<template>
<div class="container">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark" v-if="$root.isAuthenticated">
    <ul class="navbar-nav">
      <li class="nav-item">
        <router-link to="/" class="nav-link">Home</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/admin/slider/create" class="nav-link">Create Post</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/admin/slider" class="nav-link">Slider List</router-link>
      </li>
      <li class="mr-auto nav-item" v-if="$root.isAuthenticated">
        <button type="button" @click="logout" class="nav-link">Logout</button>
      </li>
      <li class="mr-auto nav-item" v-else>
        <router-link type="button" to="/login" class="nav-link">Login</router-link>
      </li>

    </ul>

  </nav><br />

  <Loader v-if="$root.loader"></Loader>

  <transition name="fade">
    <router-view></router-view>
  </transition>
</div>
</template>

<script>

import Loader from './elements/Loader.vue';
export default {
    components:{Loader},
    methods: {
        async logout(){
            this.$root.loader = true;
            await axios.post('/api/logout', {},{
                headers: {
                    'Authorization' : 'Bearer '+  localStorage.getItem('token')
                }
            })
            .then(response => {
                localStorage.removeItem('token');
                this.$router.push('/login');
                this.checkAuthenticated();
                this.$root.loader = false;
            })
            .catct(error => {
                console.error(error);
            })
        },

        checkAuthenticated(){
            const token = localStorage.getItem('token');
            if(token){
                this.$root.isAuthenticated = true
            }else{
                this.$root.isAuthenticated = false
            }
        }
    },
    mounted(){
            this.checkAuthenticated()
        }
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>
