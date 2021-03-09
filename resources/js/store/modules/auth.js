import Vue from 'vue';
import routes from "../../router/routes";

export default {
    namespaced: true,

    state() {
        return {
            token: localStorage.getItem('token') || '',
        };
    },

    actions: {
        fetch(data) {
            return Vue.auth.fetch(data);
        },

        refresh(data) {
            return Vue.auth.refresh(data);
        },

        login(ctx, data) {
            data = data || {};

            return new Promise((resolve, reject) => {
                Vue.auth.login({
                    url: 'auth/login',
                    data: data.body,
                    fetchUser: false,
                })
                    .then((response) => {
                        Vue.auth.setAuth
                        // axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token;
                        Vue.router.push({
                            name: routes.characters,
                        });
                        resolve(response);
                    }, reject);
            });
        },

        register(ctx, data) {
            data = data || {};

            return new Promise(() => {
                Vue.auth.register({
                    url: 'auth/register',
                    data: data.body,
                });
            });
        },
        logout(ctx) {
            return Vue.auth.logout();
        },
    },

    getters: {
        user() {
            return Vue.auth.user();
        },

    },


}
