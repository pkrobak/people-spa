<template>
    <the-box>
        <validation-observer v-slot="{ invalid }" ref="observer">
            <form @submit.prevent="register">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <validation-provider rules="required|email" v-slot="{errors}" name="email">
                            <div class="mb-4">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                                    E-mail
                                </label>
                                <input id="email" :class="errorClass(errors)"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                       v-model="form.email" type="text" placeholder="john@doe.com">
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <validation-provider rules="required" v-slot="{errors}" name="name">
                            <div class="mb-4">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input id="name" :class="errorClass(errors)"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                       v-model="form.name" type="text" placeholder="John Doe">
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <validation-provider rules="required|confirmed:password|min:8" v-slot="{errors}" name="password">
                            <div class="mb-6">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                                    Password
                                </label>
                                <input id="password" :class="errorClass(errors)"
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3"
                                       v-model="form.password" type="password" placeholder="******************"
                                >
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <validation-provider rules="required" v-slot="{errors}" name="password_confirmation">
                            <div class="mb-6">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="password_confirmation">
                                    Password
                                </label>
                                <input id="password_confirmation" :class="errorClass(errors)"
                                       class="shadow appearance-none rounded w-full py-2 px-3 text-grey-darker mb-3"
                                       v-model="form.password_confirmation" type="password" placeholder="******************">
                                <error-message>{{ errors[0] }}</error-message>
                            </div>
                        </validation-provider>
                        <error-message>{{ error }}</error-message>
                    </div>
                    <div class="pt-6 leading-6 font-bold sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-between">
                            <div>
                                <the-link :to="routes.login">Log in</the-link>
                            </div>
                            <div>
                                <the-button :disabled="invalid" class="rounded font-bold">
                                    Register
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
import errorMixin from "../../mixins/errorMixin";
import TheButton from "../../components/TheButton";
import routes from "../../router/routes";
import Form from "../../utils/form";
import TheLink from "../../components/TheLink";
import TheBox from "../../components/TheBox";

export default {
    mixins: [errorMixin],
    components: {
        TheButton,
        TheLink,
        TheBox,
    },
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }),
            routes,
        }
    },
    methods: {
        register() {
            this.$store
                .dispatch('auth/register', {
                    body: {
                        email: this.form.email,
                        name: this.form.name,
                        password: this.form.password,
                        password_confirmation: this.form.password_confirmation
                    },
                })
                .then(null, this.errorsFromResponse);
        },
    }
}
</script>
