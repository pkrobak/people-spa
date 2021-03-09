<template>
    <router-link class="text-xs text-blue-500 hover:text-blue-400 cursor-pointer" :to="to">
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    name: "TheLink",
    props: {
        to: String|Object,
    }
}
</script>
