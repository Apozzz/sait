import { createRouter, createWebHistory } from "vue-router"

const App = () => import('../components/App.vue')
const Welcome = () => import('../components/Welcome.vue')
const MarketsIndex = () => import('../components/markets/List.vue')
const MarketsCreate = () => import('../components/markets/Add.vue')
const MarketsEdit = () => import('../components/markets/Edit.vue')
const SectorsIndex = () => import('../components/sectors/List.vue')
const SectorsCreate = () => import('../components/sectors/Add.vue')
const SectorsEdit = () => import('../components/sectors/Edit.vue')
const RoomsIndex = () => import('../components/rooms/List.vue')
const RoomsCreate = () => import('../components/rooms/Add.vue')
const RoomsEdit = () => import('../components/rooms/Edit.vue')
const AccountLogin = () => import('../components/account/Login.vue')
const AccountLogout = () => import('../components/account/Logout.vue')
const AccountRegister = () => import('../components/account/Register.vue')

const routes = [
    {
        name: "home",
        path: "/dashboard",
        component: Welcome
    },
    {
        name: "navigation",
        path: "/dashboard",
        component: App
    },
    {
        name: "markets.index",
        path: "/markets",
        component: MarketsIndex
    },
    {
        name: "markets.create",
        path: "/markets/add",
        component: MarketsCreate
    },
    {
        name: "markets.edit",
        path: "/markets/:id/edit",
        component: MarketsEdit
    },
    {
        name: "sectors.index",
        path: "/sectors",
        component: SectorsIndex
    },
    {
        name: "sectors.create",
        path: "/sectors/add",
        component: SectorsCreate
    },
    {
        name: "sectors.edit",
        path: "/sectors/:id/edit",
        component: SectorsEdit
    },
    {
        name: "rooms.index",
        path: "/rooms",
        component: RoomsIndex
    },
    {
        name: "rooms.create",
        path: "/rooms/add",
        component: RoomsCreate
    },
    {
        name: "rooms.edit",
        path: "/rooms/:id/edit",
        component: RoomsEdit
    },
    {
        name: "login",
        path: "/login",
        component: AccountLogin
    },
    {
        name: "logout",
        path: "/logout",
        component: AccountLogout
    },
    {
        name: "register",
        path: "/register",
        component: AccountRegister
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
