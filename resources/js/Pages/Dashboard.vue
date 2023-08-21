<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

import CardEquipo from '@/Components/MyComponents/CardEquipo.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <Welcome /> -->
                    <div class="grid w-full lg:grid-cols-3 sm:grid-cols-2 p-4 justify-center">
                        <CardEquipo v-for="i in 4" :key="i" ></CardEquipo>
                    </div> 
                </div>
            </div>
        </div>
    </AppLayout>
</template>
