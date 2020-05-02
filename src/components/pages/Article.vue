<template>
    <div>
        <div class="container">
            <div class="awoo-wrapper" v-if="response === null && err === null">
                <h3>Loading the article, hang on...</h3>
            </div>

            <div class="awoo-wrapper" v-if="err !== null && err.response.data.httpCode === 404">
                <h1 style="margin-top: 0">404 Article Not Found</h1>
                <h4 style="text-align: center">Maybe the cookie monster ate it?</h4>
            </div>

            <h4 id="wrapper-pop">Posted by {{response.data.author_info.showName}} &ndash; {{response.data.created_at}}</h4>
            <div class="awoo-wrapper" style="margin-bottom: 1rem;color: white;margin-top: 0" v-if="response !== null && response.status === 200">
                <p v-html="response.data.content"></p>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import topbar from "topbar";

    export default {
        name: "Article",
        data() {
            return {
                title: "Article",
                response: null,
                err: null
            }
        },
        async mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            let res = axios.get('https://awooing.moe/api/v1/article/' + this.$route.params.id)
            await topbar.hide()
            this.response = await res
            document.title = await this.response.data.title + " – Awooing.moe"
        }
    }
</script>
