<template>
    <div>
        <!-- <Header :title="this.title"/> -->
        <div class="container">
            <div class="awoo-wrapper" style="text-align-last: center;">
                <p>Every time you refresh the page or click on the image <br> you'll see a new 
                    <img alt='Awooo' class='awoo' src='https://cdn.discordapp.com/emojis/322522663304036352.png?v=1'>
                </p>
                <h3 id="awoos-loading" v-if="imageSrc == null">Loading awoos....</h3>
                <img id="awoos-image" v-if="imageSrc !== null" @click="this.loadImage" :src="imageSrc" alt="We encountered an awooror. Please refresh.">
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import topbar from "topbar";
    export default {
        name: 'AwooPics',
        data() {
            return {
                title: "Awoo Pics",
                imageSrc: null
            }
        },
        mounted() {
            this.$emit('event_parent', "Awoo Pics")
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            this.loadImage()
        },
        methods: {
            loadImage: function() {
                topbar.show()
                axios.get('https://awooing.moe/api/v1/awoo')
                    .then(res => (this.imageSrc = "https://cdn.awooing.moe/" + res.data.path))
                    .then(topbar.hide())
            }
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
