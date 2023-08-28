<template>
  <form @submit.prevent="store" enctype="multipart/form-data" class="container mt-5">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" v-model="data.title" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" v-model="data.description" class="form-control" id="" placeholder="Write Descriptin">
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
      <input type="file" @change="fileUpload($event)" ref="image" class="form-control form-control-file" id="exampleFormControlFile1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
import {toFormData} from "axios";

export default {
  name: "SliderCreate",
  data(){
    return{
      data: {
        title: '',
        description: '',
        image: null,
        status: ''
      },
    }
  },
  methods:{
    store(){
      let formData = new FormData();
      formData.append('title', this.data.title);
      formData.append('description', this.data.description);
      formData.append('image', this.data.image);
      formData.append('status', this.data.status);

      axios.post('/api/slider', formData).then(res=>{
        this.data.title='';
        this.data.description='';
        this.data.image=null;
        this.data.status= '';
        this.$refs.image.value = ""
        alert(res.data.message);
      });
    },
    fileUpload(e){
      this.data.image = e.target.files[0];
    }
  },
    created () {
        if (!localStorage.getItem('token')){
            this.$router.push('/login')
        }
    }
}
</script>

<style scoped>
  .form-group{
    margin-bottom: 15px;
  }
</style>
