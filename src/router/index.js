import Vue from 'vue'
import VueRouter from "vue-router"
import AwooPics from "@/components/pages/AwooPics"
import Council from "@/components/pages/Council"
import News from "@/components/pages/News"
import Home from "@/components/pages/Home"
import Article from "@/components/pages/Article";

Vue.use(VueRouter)
export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/news/:page',
            name: 'News',
            component: News,
        },
        {
            path: '/news',
            redirect: '/news/1'
        },
        {
            path: '/article/:id',
            name: 'Article',
            props: true,
            component: Article
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