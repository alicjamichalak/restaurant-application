<template>
    <div>
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" @click="toggleSidebar">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</template>

<script>
    export default {
        name: "SidebarToggleTop",
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
