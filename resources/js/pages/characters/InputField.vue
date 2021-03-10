<template>
    <div class="divide-y divide-gray-200">
        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <validation-provider :rules="rules" v-slot="{errors}" :name="validatorKey">
                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" :for="validatorKey">
                        {{ label }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                           type="text"
                           :id="validatorKey"
                           :class="errorClass(errors)"
                           :value="value"
                           @input="$emit('update:value', $event)"
                           :placeholder="placeholder">
                    <error-message>{{ errors[0] }}</error-message>
                </div>
            </validation-provider>
        </div>
    </div>
</template>

<script>
import errorMixin from "../../mixins/errorMixin";

export default {
    name: "InputField",
    mixins: [errorMixin],
    props: {
        validatorKey: String,
        label: String,
        placeholder: String,
        value: String,
        rules: String|Object,
    },
    data() {
        return {
            innerValue: '',
        }
    },
    mounted() {
        this.innerValue = this.value;
    }
}
</script>
