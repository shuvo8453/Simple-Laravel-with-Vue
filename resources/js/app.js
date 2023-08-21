import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js'
import AppComponent from './components/App.vue'
import router from './router/index'

const app = createApp({
    components: {
        AppComponent,
    },
    data() {
        return {
            loader: false,
            isAuthenticated: false,
        }
      }
});

app.use(router)
app.mount('#app')
