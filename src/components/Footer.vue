<template>
    <!-- ::Includes/footer -->
    <footer id="Awooter" class="footer awoo-gradient">
        <div class="container">
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <ul class="nav nav-footer" style="display: unset;">
                        <li><a class="ajax" href="{$baseUrl}">Awooing.moe</a> 2020</li>
                        <li>This website is part of the <a href="https://github.com/Awooing">Project Awooing</a>.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
                        <li><a href="https://discord.gg/wolke">Join the Awoo Community Discord</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- \::Includes/footer -->
</template>
<script>
    export default {
        name: 'Footer'
    }
</script>

<style scoped>
    ul.nav.nav-footer img.awoo {
        height: 3rem;
    }
</style>