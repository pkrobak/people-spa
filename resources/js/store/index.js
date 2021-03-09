import Vue  from 'vue';
import Vuex from 'vuex';

import auth from './modules/auth.js';
import character from "./modules/character";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        character,
    },

    strict: true
});
