<template>
    <div>
        <Header :title="this.title"/>
        <div class="container">

        </div>
    </div>
</template>

<script>
    import Header from "@/components/Header";
    export default {
        components: {Header},
        title: "Article",
        name: "Article"
    }
</script>
