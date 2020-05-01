<template>
    <div>
        <Header :title="this.title"/>
        <div class="container">
            <div class="awoo-wrapper" v-for="article in this.data.news" :key="article.id">
                <a class="title-link ajax" href="#">{{article.title}}</a>
                <h4 style="font-size: 1rem;font-weight: 300;color: var(--gray);margin: 0">By {{article.author_info.showName}} &ndash; {{article.created_at}}</h4>
                <span v-html="article.content"></span> <a style="border-radius: 2rem;margin-top: 4px" class="btn btn-primary float-right ajax" href="">See more</a>
            </div>

            <!-- TODO: make this work -->
            <p style="text-align: center;margin-right: 1rem;margin-top: 1rem;margin-bottom: 1rem;">
                <span v-if="this.data.pageInfo.current > 1">First | Previous | </span>
                Page {{this.data.pageInfo.current}} from {{this.data.pageInfo.last}}
                <span v-if="this.data.pageInfo.current < this.data.pageInfo.last"> | Next | Last</span>
            </p>

        </div>
    </div>
</template>

<script>
    import topbar from "topbar";
    import axios from "axios";
    import Header from "@/components/Header";

    export default {
        name: 'News',
        components: {Header},
        data() {
            return {
                title: "News",
                data: null
            }
        },
        async mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            axios.get('https://awooing.moe/api/v1/news?page=' + this.$route.params.page + '&strip=true&truncate=200&pageInfo=true')
                .then(res => (this.data = res.data))
                .then(topbar.hide)
        }
    }
</script>