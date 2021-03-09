<template>
    <the-box>
        <pulse-loader v-if="isLoading"></pulse-loader>
        <template v-else>
            <div>
                <form @submit.prevent="">
                    <input-field placeholder="John Doe"
                                 rules="string|max:191"
                                 label="Name"
                                 validator-key="name"
                                 :value="value.name"
                                 @update:value="value.name = $event.target.value"
                    ></input-field>
                    <input-field placeholder="www.example.com"
                                 :rules="{ regex: /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/ }"
                                 label="Url"
                                 validator-key="url"
                                 :value="value.url"
                                 @update:value="value.url = $event.target.value"
                    ></input-field>
                    <input-field placeholder="Culture"
                                 rules="string|max:191"
                                 label="Culture"
                                 validator-key="culture"
                                 :value="value.culture"
                                 @update:value="value.culture = $event.target.value"
                    ></input-field>
                </form>
            </div>
            <div class="flex justify-between">
                <div>
                    <a class="text-xs text-blue-500 hover:text-blue-400 cursor-pointer"
                       @click="$router.push({name: characters})"
                    >Back</a>
                </div>
                <div>
                    <the-button :disabled="isUpdating" @clicked="update" class="rounded font-bold">Save</the-button>
                </div>
            </div>
        </template>
    </the-box>
</template>

<script>
import TheBox from "../../components/TheBox";
import errorMixin from "../../mixins/errorMixin";
import {mapGetters} from "vuex";
import InputField from "./InputField";
import TheLink from "../../components/TheLink";
import loaderMixin from "../../mixins/loaderMixin";
import routes from "../../router/routes";
import TheButton from "../../components/TheButton";

export default {
    name: "CharacterShow",
    mixins: [errorMixin, loaderMixin],
    data() {
        return {
            characters: routes.characters,
            value: {},
        }
    },
    components: {
        TheButton,
        TheLink,
        InputField,
        TheBox,
    },
    props: {
        id: Number,
    },
    computed: {
        ...mapGetters('character', ['byId', 'isLoading', 'isUpdating']),  // da sie dodac tutaj alias i parametr, zeby nie dodawac ponizszego computed prop?
        character: {
            get() {
                return this.value = {...this.byId(this.id)};
            },
            set(value) {}
        }
    },
    mounted() {
        this.value = {...this.byId(this.id)};
    },
    methods: {
        update() {
            this.$store.dispatch('character/update', this.value)
            this.$router.back();
        },
    },
}
</script>
