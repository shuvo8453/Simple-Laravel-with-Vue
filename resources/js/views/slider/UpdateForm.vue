<template>
  <div>
    <h1>Edit Post</h1>
    <form @submit.prevent="updateSlider">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" v-model="data.title" class="form-control" id="title" >
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" v-model="data.description" class="form-control" id="">
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" v-model="data.status" id="">
          <option value="">-</option>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Image :</label>
        <img :src="data.url" height="100" width="100" class="m-4">
        <input type="file" @change="fileUpload($event)" ref="image" class="form-control form-control-file" id="exampleFormControlFile1">
      </div>
      <br />
      <div class="form-group">
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Edit",
  data(){
    return{
      data: []
    }
  },
  methods:{
    getSliderData(){
      axios.get(`/slider/${this.$route.params.id}/edit` ).then(res=> {
        console.log(res.data.title)
        this.data = res.data
      })
          .catch(error => {
            console.error(error)
          })
    },
    updateSlider(){
      axios.post(`/slider/${this.$route.params.id}`, {_method:"put", title: this.data.title}).then(res => {
        this.$router.push({name: 'slider.index'})
      })
    }
  },
  mounted() {
    this.getSliderData()
  }
}
</script>

<style scoped>

</style>