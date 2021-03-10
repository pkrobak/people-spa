<template>
    <the-box>
        <validation-observer v-slot="{ invalid }" ref="observer">
            <form @submit.prevent="login">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <validation-provider rules="required|email" v-slot="{errors}" name="email">
                            <div class="mb-4">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                                    E-mail
                                </label>
                                <input id="email" :class="errorClass(errors)"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                       v-model="form.email" type="text" placeholder="E-mail">
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <validation-provider rules="required" v-slot="{errors}" name="password">
                            <div class="mb-6">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                                    Password
                                </label>
                                <input id="password" :class="errorClass(errors)"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3"
                                       v-model="form.password" type="password" placeholder="******************">
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <error-message>{{ error }}</error-message>
                    </div>
                    <div class="pt-6 leading-6 font-bold sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <the-link :to="routes.register">Register</the-link>
                            </div>
                            <div>
                                <the-button :disabled="invalid" class="rounded font-bold">
                                    Log In
                                </the-button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </validation-observer>
    </the-box>
</template>

<script>
import TheButton from '../../components/TheButton';
import routes from '../../router/routes';
import Form from "../../utils/form";
import TheLink from "../../components/TheLink";
import errorMixin from "../../mixins/errorMixin";
import TheBox from "../../components/TheBox";

export default {
    components: {TheBox, TheLink, TheButton},
    mixins: [errorMixin],
    data() {
        return {
            form: new Form({
                email: null,
                password: null,
            }),
            routes,
        }
    },
    methods: {
        login() {
            this.$auth.login({
                data: {
                    email: this.form.email,
                    password: this.form.password
                },
                redirect: {name: routes.characters},
                remember: true,
                fetchUser: false,
                staySignedIn: true,
            })
            .then(res => {
                axios.defaults.headers.common['Content-Type'] = 'application/json';
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.access_token;
                this.$store.dispatch('character/fetch', {page: 1});
            })
        },
    }
}
</script>
