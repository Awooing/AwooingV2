<template>
    <div>

    </div>
</template>

<script>
    import topbar from "topbar";

    export default {
        name: 'News',
        mounted() {
            topbar.config({barColors: {0:"#281483", .3:"#8f6ed5", 1.0:"#d782d9"}})
            topbar.show()
            // todo: hide in axios promise then
            topbar.hide()
        }
    }
</script>