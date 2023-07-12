<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Component</div>
  
                    <div class="card-body">

                        <br/>
                        <router-link to="/about">Go to About</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: []
        }
    },
    methods:{
        getSlider(){
            axios.get('/slider', {params: {allData: 1}}).then(res=>{
                this.data = res.data;
            })
        },

    },
    mounted(){
        this.getSlider();
    },
    created () {

    }
}
</script>

<style>

</style>