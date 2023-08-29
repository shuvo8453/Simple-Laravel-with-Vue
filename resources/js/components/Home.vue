<template>
  <div class="container" style="height: 300px;" v-if="data">
    <div id="imageSlider" class="carousel slide">

      <div class="carousel-indicators" >
        <button v-for="(image,index) in data" :key="index" type="button" data-bs-target="#imageSlider" :data-bs-slide-to="index" :class="[{'active':index === 0}]" :aria-current="index === 0" aria-label="Slide 1"></button>
      </div>
      <div class="carousel-inner" v-for="(image,index) in data" :key="index">
          <div :class="['carousel-item' ,{'active':index === 0}]" >
            <img :src="image.url" class="d-block w-100" alt="" height="550" width="100">
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ image.title }}</h5>
              <p>{{ image.description }}</p>
            </div>
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            data: []
        }
    },
    methods:{
        getSlider(){
            axios.get('/api/slider', {params: {allData: 1} ,
                headers: {
                    'Authorization' : 'Bearer '+  localStorage.getItem('token')
                }
            }).then(res=>{
                this.data = res.data;
              console.log(this.data)
            })
        },

    },
    mounted(){
        this.getSlider();
    },
}
</script>

<style>

</style>
