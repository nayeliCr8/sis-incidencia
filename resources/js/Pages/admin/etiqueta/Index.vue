<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head} from "@inertiajs/vue3";
import CardEquipo from '@/Components/MyComponents/datatable.vue'
import Datatable from "@/Components/MyComponents/datatable.vue";

</script>
<template>
    <Head title="Dashboard"/>
    
    <AdminLayout>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        PANEL ETIQUETA
                    </div>
                    
                </div>
                <Datatable></Datatable>
            </div>
        </div>
    </AdminLayout>
</template>

<style lang="scss" scoped>

</style>