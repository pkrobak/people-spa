<template>
    <div id="main">
        <div id="content">
            <table-layout>
                <transition name="fade" mode="out-in">
                    <router-view :key="$route.path"></router-view>
                </transition>
            </table-layout>
        </div>
    </div>
</template>

<script>
import TableLayout from "./components/TableLayout";

export default {
    components: {TableLayout},
}
</script>
