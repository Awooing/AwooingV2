<template>
    <div>
        <Header :title="this.title"/>
        <div class="container">
            <div class="awoo-wrapper" style="background: rgba(0,0,0,0.2);padding: 2rem;border-radius: 2rem;margin-top: 2rem">
                <h2 style="text-align:center;color: white;font-weight: 700;">Welcome to the <img alt="Awooo" class="awoo" src="https://cdn.discordapp.com/emojis/322522663304036352.png?v=1">ing Place</h2>
                <h5 style="text-align:center;color: darkgray;text-transform: uppercase;">Where the <img alt="Awooo" class="awoo" src="https://cdn.discordapp.com/emojis/322522663304036352.png?v=1">ers go</h5>
            </div>
            <h2 id="title-homepage">Latest News</h2>
            <!-- v-for="member in members" :key="member.id" -->
            <div v-for="article in this.news.news" :key="article.id" class="awoo-wrapper">
                <a class="title-link ajax" href="#">{{article.title}}</a>
                <h4 style="font-size: 1rem;font-weight: 300;color: var(--gray);margin: 0">By {{article.author_info.showName}} &ndash; {{article.created_at}}</h4>

                <span v-html="article.content"></span> <a style="border-radius: 2rem;margin-top: 4px" class="btn btn-primary float-right ajax" href="#">See more</a>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import topbar from "topbar";
    import Header from "@/components/Header";
    export default {
        name: 'News',
        components: {Header},
        data() {
            return {
                title: "Home",
                news: null
            }
        },
        mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            axios.get('https://awooing.moe/api/v1/news?strip=true&truncate=200')
                .then(res => (this.news = res.data))
                .then(topbar.hide)
        }
    }
</script>