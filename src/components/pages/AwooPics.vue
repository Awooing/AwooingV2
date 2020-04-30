<template>
    <div class="awoo-wrapper" style="text-align-last: center;">
        <p>Every time you refresh the page, you'll see a new <img alt='Awooo' class='awoo' src='https://cdn.discordapp.com/emojis/322522663304036352.png?v=1'></p>
        <h3 id="awoos-loading">Loading awoos....</h3>
        <img id="awoos-image" :src="'https://cdn.awooing.moe/' + this.response.path" alt="We encountered an awooror. Please refresh.">
    </div>

</template>

<script>
    import axios from 'axios'
    export default {
        name: 'AwooPics',
        data() {
            return {
                response: null
            }
        },
        mounted() {
            axios.get('http://localhost:4000/api/v1/awoo')
                .then(res => (this.response = res.data))
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