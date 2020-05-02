<template>
    <div>
        <div class="container">
            <div v-if="this.data !== null && this.data.news !== null">
                <div class="awoo-wrapper" v-for="article in this.data.news" :key="article.id">
                    <a class="title-link ajax" href="#">{{article.title}}</a>
                    <h4 style="font-size: 1rem;font-weight: 300;color: var(--gray);margin: 0">By {{article.author_info.showName}} &ndash; {{article.created_at}}</h4>
                    <span v-html="article.content"></span> <router-link :to="'/article/' + article.id" class="btn btn-primary float-right">See more</router-link>
                </div>
            </div>
            <!-- TODO: make this work -->
            <div v-if="this.data !== null && this.data.pageInfo !== null">
                <p style="text-align: center;margin-right: 1rem;margin-top: 1rem;margin-bottom: 1rem;">
                    <span v-if="this.data.pageInfo.current > 1">
                        <router-link @click="this.reloadPage" to="/news/1">First</router-link> |
                        <router-link @click="this.reloadPage" :to="'/news/' + (this.data.pageInfo.current - 1)">Previous</router-link> |
                    </span>
                    Page {{this.data.pageInfo.current}} from {{this.data.pageInfo.last}}
                    <span v-if="this.data.pageInfo.current < this.data.pageInfo.last"> |
                        <router-link @click="this.reloadPage" :to="'/news/' + (this.data.pageInfo.current + 1)">Previous</router-link> |
                        <router-link @click="this.reloadPage" :to="'/news/1'">First</router-link>
                    </span>
                </p>
            </div>

        </div>
    </div>
</template>

<script>
    import topbar from "topbar";
    import axios from "axios";
    export default {
        name: 'News',
        data() {
            return {
                title: "News",
                data: null,
                something: 0
            }
        },
        async mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            axios.get('https://awooing.moe/api/v1/news?page=' + this.$route.params.page + '&strip=true&truncate=200&pageInfo=true')
                .then(res => (this.data = res.data))
                .then(topbar.hide())
        },
        methods: {
            reloadPage: function () {
                alert('yo')
                location.reload()
            }
        }
    }
</script>
<style scoped>
    .btn.btn-primary {
        margin-top: 10px;
        margin-bottom: 10px;
        border-radius: 1rem;
    }
</style>