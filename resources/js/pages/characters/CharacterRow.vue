<template>
    <tr class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ index }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.name }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">
            <external-link :url=" character.url"></external-link>
        </td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.gender }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.culture }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.born }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.died }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.created_at }}</td>
        <td class="py-3 px-6 text-left whitespace-nowrap">{{ character.updated_at }}</td>
        <td>
            <div class="flex items-center justify-center">
                <the-link :to="{name: show, params: {id: character.id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </the-link>
            </div>
        </td>
    </tr>
</template>

<script>
import ExternalLink from "../../components/ExternalLink";
import routes from "../../router/routes";
import TheLink from "../../components/TheLink";

export default {
    name: "CharacterRow",
    components: {TheLink, ExternalLink},
    props: {
        character: Object,
        index: Number,
    },
    data() {
        return {
            show: routes.character
        }
    },
}
</script>
