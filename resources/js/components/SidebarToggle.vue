<template>
    <div>
        <button class="rounded-circle border-0" @click="toggleSidebar" id="sidebarToggle"></button>
    </div>
</template>

<script>
    export default {
        name: "SidebarToggle",
        methods: {
            toggleSidebar() {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
                if ($(".sidebar").hasClass("toggled")) {
                    $('.sidebar .collapse').collapse('hide');
                }
            }
        }
    }
</script>

<style scoped>

</style>
