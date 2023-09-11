<template>
    <h1>Registration</h1>
    <form @submit.prevent="registration">
        <div class="container">
            <div class="">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" v-model="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" v-model="email">
                    <div id="email" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" v-model="password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" v-model="confirm_password">
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
            confirm_password: ''
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
        }
    }
}
</script>

<style>

</style>
