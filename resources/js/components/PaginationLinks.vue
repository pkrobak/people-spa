<template>
    <div class="px-5 py-5 flex flex-col xs:flex-row items-center xs:justify-between">
        <span class="text-xs xs:text-sm text-gray-900">
            {{ currentPage }} of {{ lastPage }}
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <the-button class="text-sm rounded-l font-semibold"
                        :disabled="!hasPreviousPage"
                        :inverted="true"
                        @clicked="changePage(-1)"
            >Prev
            </the-button>
            <the-button class="text-sm rounded-r font-semibold"
                        :disabled="!hasNextPage"
                        :inverted="true"
                        @clicked="changePage(1)"
            >Next
            </the-button>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TheButton from "./TheButton";
import routes from "../router/routes";

export default {
    name: "PaginationLinks",
    components: {TheButton},
    computed: {
        ...mapGetters('character', ['currentPage', 'lastPage', 'hasNextPage', 'hasPreviousPage'])
    },
    methods: {
        changePage(offset) {
            const page = parseInt(this.$route.query.page) + offset;
            this.$router.push({name: routes.characters, query: {...this.$route.query, page: page}})
            this.$store.dispatch('character/fetch', {
                ...this.$route.query,
                page
            })
        },
    },
}
</script>
