import * as api from '../../api/characters';

export default {
    namespaced: true,
    state() {
        return {
            characters: [],
            pagination: { // moze jako sub moduł?
                currentPage: 1,
                lastPage: 1,
            },
            isLoading: false,
            isUpdating: false,
        }
    },
    actions: {
        update({state, commit}, {id, name, gender, culture, url, died, born}) {
            commit('setUpdating', true)
            return api.update(id, {name, gender, culture, url, died, born})
                .then(({data}) => {
                    commit('update', data.character)
                    commit('setUpdating', false)
                })
                .catch(e => {
                    commit('setUpdating', false)
                    throw e;
                })
        },
        fetch({commit}, params) {
            commit('setLoading', true)
            commit('setCharacters', []);
            api.list(params)
                .then(({data}) => {
                    commit('setPagination', data)
                    commit('setCharacters', data.data)
                    commit('setLoading', false)
                })
        }
    },
    mutations: {
        update(state, {id, name, gender, culture, url, died, born, created_at, updated_at}) { // ten parametr az sie prosi jako interfejs w typescript, ale brak czasu
            const index = state.characters.findIndex(character => character.id === id);
            if (index === -1) {
                return false;
            }
            state.characters[index] = {id, name, gender, culture, url, died, born, created_at, updated_at};
        },
        setCharacters(state, characters) {
            state.characters = characters;
        },
        setPagination(state, {current_page, last_page}) {
            state.pagination.currentPage = current_page;
            state.pagination.lastPage = last_page;
        },
        setLoading(state, loading) {
            state.isLoading = loading;
        },
        setUpdating(state, updating) {
            state.isUpdating = updating;
        }
    },
    getters: {
        all: (state) => state.characters,
        byId: (state) => ((id) => state.characters.find(character => character.id === id)),
        currentPage: (state) => state.pagination.currentPage,
        lastPage: (state) => state.pagination.lastPage,
        hasNextPage: (state) => state.pagination.currentPage < state.pagination.lastPage,
        hasPreviousPage: (state) => state.pagination.currentPage > 1,
        isLoading: (state) => state.isLoading,
        isUpdating: (state) => state.isUpdating,
    }
}
