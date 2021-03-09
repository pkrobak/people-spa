<template>
    <button class="text-white py-2 px-4"
            :disabled="disabled"
            :class="classes"
            :type="type"
            @click="$emit('clicked')"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "TheButton",
    props: {
        inverted: {
            type: Boolean,
            default: false,
        },
        submit: {
            type: Boolean,
            default: true,
        },
        disabled: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        classes() {
            const classes = [];
            if (this.disabled) {
                classes.push('disabled:opacity-50');
            }
            classes.push(this.inverted
                ? 'bg-white border-2 border-blue-500 hover:bg-blue-50 text-blue-500'
                : 'bg-blue-500 hover:bg-blue-400');

            return classes.join(' ');
        },
        type() {
            if (this.submit) {
                return 'submit';
            }

            return 'button';
        }
    },
}
</script>

