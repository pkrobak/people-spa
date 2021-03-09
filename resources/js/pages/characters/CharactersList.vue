<template>
    <div>
        <character-filters></character-filters>
        <table class="min-w-max w-full table-auto">
            <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Index</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Url</th>
                <th class="py-3 px-6 text-left">Gender</th>
                <th class="py-3 px-6 text-left">Culture</th>
                <th class="py-3 px-6 text-left">Born</th>
                <th class="py-3 px-6 text-left">Died</th>
                <th class="py-3 px-6 text-left">Created At</th>
                <th class="py-3 px-6 text-left">Updated At</th>
                <th class="py-3 px-6 text-left">Action</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            <tr v-if="isLoading">
                <td colspan="10" class="text-center h-96">
                    <pulse-loader></pulse-loader>
                </td>
            </tr>
            <tr v-else-if="!isLoading && !all.length">
                <td colspan="10" class="text-center h-12">
                    <h2>No data fetched</h2>
                </td>
            </tr>
            <tr v-for="(character, index) in all" is="character-row"
                :key="character.id"
                :character="character"
                :index="$route.query.page * perPage + ++index - perPage"
            ></tr>
            </tbody>
        </table>
        <pagination-links></pagination-links>
    </div>
</template>

<script>
import CharacterRow from "./CharacterRow";
import PaginationLinks from "../../components/PaginationLinks";
import CharacterFilters from "./CharacterFilters";
import {mapGetters} from 'vuex';
import loaderMixin from "../../mixins/loaderMixin";
import {PER_PAGE} from "../../utils/pagination";

export default {
    name: "CharactersList",
    mixins: [loaderMixin],
    components: {
        CharacterFilters,
        PaginationLinks,
        CharacterRow,
    },
    data() {
        return {
            perPage: PER_PAGE
        }
    },
    computed: {
        ...mapGetters('character', ['all', 'isLoading'])
    },
}
</script>

