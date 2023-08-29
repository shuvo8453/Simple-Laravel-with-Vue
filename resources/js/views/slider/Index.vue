<template>
  <table class="table container">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Image Title</th>
      <th scope="col">Image Description</th>
      <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody v-for="image in data" :key="image.id">
    <tr>
      <th scope="row">{{ image.id }}</th>
      <td><img :src="image.url" height="40" width="40"></td>
      <td>{{ image.title }}</td>
      <td>{{ image.description }}</td>
      <td>
        <router-link :to="'/admin/slider/update/' + image.id" class="btn btn-secondary">edit</router-link>
        <button class="btn btn-danger" @click="deleteSliderData(image.id)">delete</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "index",
  data(){
    return {
      data: [],
    }
  },
  methods:{
    async getSliderData(){
        this.$root.loader = true;
      await axios.get('/api/get/slider', ).then(res=> {
        this.data = res.data
        this.$root.loader = false;
      })
        .catch(error => {
          console.error(error)
        })
    },

    async deleteSliderData(id){
        this.$root.loader = true;
        await axios.delete(`/api/slider/${id}`).then(res=> {
            this.$root.loader = false;
            this.getSliderData();
        })
    }
  },
  mounted() {
    this.getSliderData()
  },
}
</script>

<style scoped>

</style>
