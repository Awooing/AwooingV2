<template>
    <div>
        <div class="section section-hero section-shaped" id="awoo-banner">
            <div class="shape shape-style-1 shape-primary awoo-banner-gradient">
            </div>
            <div class="page-header">
                <div class="container shape-container d-flex align-items-center py-lg">
                    <div class="col px-0">
                        <!-- TODO: Changing Title -->
                        <h1 class="welcome shadowed" style="margin:0;display: inline-block;">{{this.title}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <Navigation/>
    </div>
</template>

<script>
    import Navigation from "@/components/Navigation"
    export default {
        name: "Header",
        components: {Navigation},
        props: {
            title: String
        },
        mounted() {
            if (this.title !== "Article") {
                document.title = this.title + " – Awooing.moe";
            }
        }
    }
</script>

<style>
    .modal-backdrop {
        transition: all 0.18s ease-in-out;
        background: rgba(0,0,0,0.3);
    }
</style>