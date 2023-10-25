import axios from "axios";

import App from "./App.vue";
import {createApp} from "vue";
import router from "./Router/router";
createApp(App)
    .use(router, axios)
    .mount('#app')
