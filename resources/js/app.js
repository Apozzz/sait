require('./bootstrap');
require('alpinejs')

import { createApp } from 'vue'
import router from './router'
import HomePage from './components/Welcome'
import Navigation from './components/App'

createApp({
    components:{
        home: HomePage,
        navigation: Navigation
    }
}).use(router).mount('#app')
