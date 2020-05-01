<template>
    <div>
        <Header :title="this.title"/>
        <div class="container">
            <div class="awoo-wrapper" style="text-align-last: center;">
                <p>Every time you refresh the page, you'll see a new <img alt='Awooo' class='awoo' src='https://cdn.discordapp.com/emojis/322522663304036352.png?v=1'></p>
                <!-- todo: remove text on image load -->
                <h3 id="awoos-loading">Loading awoos....</h3>
                <img id="awoos-image" :src="'https://cdn.awooing.moe/' + this.response.path" alt="We encountered an awooror. Please refresh.">
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import topbar from "topbar";
    import Header from "@/components/Header";
    export default {
        name: 'AwooPics',
        components: {Header},
        data() {
            return {
                title: "Awoo Pics",
                response: null
            }
        },
        async mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            axios.get('https://awooing.moe/api/v1/awoo')
                .then(res => (this.response = res.data))
                .then(topbar.hide)
            await document.getElementById("awoos-loading").remove()
            // todo: doesnt work please help or ill die here
        }
    }
</script>

<style scoped>
    #awoos-image {
        height: 50%;
        width: 50%;
        object-fit: contain;
    }
</style>