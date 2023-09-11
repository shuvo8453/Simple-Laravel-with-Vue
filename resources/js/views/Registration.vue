<template>
    <h1>Registration</h1>
    <form @submit.prevent="registration">
        <div class="container">
            <div class="">
                <div class="mb-3">
                    <label for="name" class="form-label required">Name</label>
                    <input type="name" class="form-control" v-model="name">
                    <label class="text-danger" v-if="erros.name">{{ erros.name[0] }}</label>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label required">Email address</label>
                    <input type="email" class="form-control" v-model="email">
                    <label class="text-danger" v-if="erros.email">{{ erros.email[0] }}</label>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label required">Password</label>
                    <input type="password" class="form-control" v-model="password">
                    <label class="text-danger" v-if="erros.password">{{ erros.password[0] }}</label>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label required">Confirm Password</label>
                    <input type="password" class="form-control" v-model="confirm_password">
                    <label class="text-danger" v-if="erros.password">{{ erros.password[0] }}</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios'
export default {
    name: 'Registration',
    data(){
        return{
            name: '',
            email: '',
            password: '',
            confirm_password: '',
            erros: ''
        }
    },
    methods: {
        async registration(){
            await axios.post('/api/registration',{
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirm_password
            })
            .then(response => {
                if(response.data.success){
                    this.$router.push('/login')
                }
            })
            .catch(error => {
                console.log(error.response.data, 456);
                this.erros = JSON.parse(error.response.data);
            })
        }
    }
}
</script>

<style scoped>
.required:after {
    content:" *";
    color: red;
  }
</style>
