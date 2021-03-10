<template>
    <form @submit.prevent="" class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select v-model="form.gender" @change="fetch"
                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value=""></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="block relative">
            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Name..." v-model="form.name" @blur="fetch" @keyup.enter="fetch"
                   class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>
    </form>
</template>

<script>
import routes from "../../router/routes";
import Form from "../../utils/form";
import clear from "../../utils/clear";

export default {
    name: "CharacterFilters",
    data() {
        return {
            form: new Form({
                gender: '',
                name: '',
            })
        }
    },
    methods: {
        fetch() {
            const query = clear({...this.$route.query, ...this.form.data()});
            delete query.page;
            this.$router.push({
                name: routes.characters,
                query
            });
            this.$store.dispatch('character/fetch', query);
        }
    },
    mounted() {
        const name = this.$route.query.name;
        if (name) {
            this.form.name = name;
        }
        const gender = this.$route.query.gender;
        if (gender) {
            this.form.gender = gender;
        }
    }
}
</script>
