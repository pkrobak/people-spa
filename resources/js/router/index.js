import VueRouter from 'vue-router'

import Register from '../pages/auth/Register'
import Login from '../pages/auth/Login'
import CharactersList from '../pages/characters/CharactersList'
import routes from "./routes";
import NotFound from '../pages/NotFound'
import CharacterShow from "../pages/characters/CharacterShow";

import Vue from '../store/index';
import {getPageById} from "../utils/pagination";

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes: [
        {
            path: '/register',
            name: routes.register,
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: routes.login,
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/characters',
            name: routes.characters,
            component: CharactersList,
            meta: {
                auth: false
            },
        },
        {
            path: '/characters/:id/',
            component: CharacterShow,
            name: routes.character,
            meta: {
                auth: false,
            },
            props: route => ({id: parseInt(route.params.id)}),
        },
        {
            path: '*',
            component: NotFound,
        }
    ],
})
router.beforeEach((to, from, next) => {
    if (from.name !== null || !to.fullPath.startsWith('/' + routes.character)) {
        return next();
    }

    if (to.name === routes.characters) {
        if (!to.query.page) {
            to.query.page = 1;
        }
        Vue.dispatch('character/fetch', to.query)
        next();
    }
    if (to.name === routes.character) {
        const id = to.params.id;
        if (!id) {
            return next({name: routes.characters, params: {page: 1}})
        }

        Vue.dispatch('character/fetch', getPageById(parseInt(id)))
            .then(() => next());
    }
})

export default router
