<template>
    <a :href="url" class="hover:underline text-blue-500" target="_blank">{{ url }}</a>
</template>

<script>
export default {
    name: "ExternalLink",
    props: {
        url: String,
    }
}
</script>

<style scoped>

</style>
