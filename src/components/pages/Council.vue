<template>
    <div>
        <Header :title="this.title"/>
        <div class="container">
            <div v-for="member in members" :key="member.id" class="council-block" style="align-items: flex-start;display: flex;text-align: left;margin: 1rem;background: rgba(0,0,0,0.3);padding: 1rem;border-radius: 2rem;color: white;">
                <img style="border-radius: 4rem;min-height: 128px" :src="member.discord_avatar" :alt="member.name">
                <div style="margin-left: 1rem;color:white">
                    <h4 style="margin: 0">{{member.name}} <span style="font-size: 0.8rem">{{member.position}}</span></h4>
                    <h3 style="font-size: .9rem;color: gray" v-html="member.about"></h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import topbar from 'topbar'
    import Header from "@/components/Header";
    export default {
        name: 'Council',
        components: {Header},
        data() {
            return {
                title: "Council",
                members: null
            }
        },
        mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            axios.get('https://awooing.moe/api/v1/council')
                .then(res => (this.members = res.data))
                .then(topbar.hide)
        }
    }
</script>