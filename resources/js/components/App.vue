<template>
<div class="container">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
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
    </ul>
  </nav><br />
  <transition name="fade">
    <router-view></router-view>
  </transition>
</div>
</template>

<script>
export default {

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