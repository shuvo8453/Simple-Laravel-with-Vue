<template>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5 mx-auto">
            <form v-on:submit.prevent="login">
              <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

              <div class="form-group">
                <label for="email"> Email Address </label>
                <input type="email" v-model="email" class="form-control mt-2" name="email" placeholder="enter email address">
              </div>

              <div class="form-group password-input">
                <label for="password"> Password </label>
                <input
                    v-model="password"
                    :type="showPassword ? 'text' : 'password'"
                    class="form-control mt-2"
                    name="password"
                    placeholder="enter password"
                />
                <button type="button" @click="toggleShowPassword" class="eye-button">
                    <i  :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
              </div>

              <router-link class="btn btn-lg btn-primary btn-block mt-2" to="/"> Sign up </router-link>
              <button class="btn btn-lg btn-primary btn-block mt-2 float-end" type="submit"> Sign in </button>
            </form>
      </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'PasswordInput',
    data(){
        return{
            email: '',
            password: '',
            showPassword: false,
        }
    },

    methods:{
        async login(){
            this.$root.loader = true;
            await axios.post('/api/login',{
                email: this.email,
                password: this.password
            })
            .then(response => {
                const token = response.data.token;
                localStorage.setItem('token', token)
                this.$router.push('/admin/slider');
                this.$root.isAuthenticated = true;
                this.$root.loader = false;
            })
            .catch(error => {
                console.error(error);
            })
        },
        toggleShowPassword() {
            this.showPassword = !this.showPassword;
        },
    }
}
</script>

<style scoped>
    .password-input {
  position: relative;
}

.eye-button {
  position: absolute;
  top: 70%;
  right: 10px;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
}

</style>
