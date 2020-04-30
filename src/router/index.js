import Vue from 'vue'
import VueRouter from "vue-router"
import AwooPics from "@/components/pages/AwooPics"
import Council from "@/components/pages/Council"
import News from "@/components/pages/News"
import Home from "@/components/pages/Home"

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/News',
            name: 'News',
            component: News
        },
        {
            path: '/awoo/random',
            name: 'AwooPics',
            component: AwooPics
        },
        {
            path: '/council',
            name: 'Council',
            component: Council
        }
    ]
})