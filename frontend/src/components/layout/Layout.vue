<template>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <header-layout />

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <slot />

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    <!-- Scroll to Top Button-->
</template>
<script>
    import HeaderLayout from '@/components/layout/Header'
    export default {
        components: {
            HeaderLayout,
        }
    }
</script>