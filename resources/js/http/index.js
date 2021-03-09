import Vue from 'vue';

import axios    from 'axios';
import VueAxios from 'vue-axios';

axios.defaults.baseURL = process.env.MIX_APP_URL;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.use(VueAxios, axios);

export default {
    root: process.env.VUE_APP_API_URL
};
