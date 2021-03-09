<template>
    <h1>NotFound</h1>
</template>
<script>
import routes from "../router/routes";

export default {
    mounted() {
        if (this.$auth.check()) {
            return this.$router.push(routes.characters);
        }

        return this.$router.push(routes.login);
    }
}
</script>
