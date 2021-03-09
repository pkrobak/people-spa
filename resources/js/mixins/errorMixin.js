import ErrorMessage from "../components/ErrorMessage";

export default {
    data() {
        return {
            error: null,
        }
    },
    components: {
        ErrorMessage,
    },
    methods: {
        errorClass(errors) {
            if (errors.length > 0) {
                return 'border border-red-800';
            }
        },
        errorsFromResponse({response}) {
            this.error = response.data.message;
            const errors = response.data.errors;
            if (errors) {
                Object.keys(errors).forEach(key => {
                    this.$refs.observer.errors[key].push(errors[key][0]);
                })
            }
        }
    }
}
