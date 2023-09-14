<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head} from "@inertiajs/vue3";

import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";

defineProps({
    incidencias: Object,
});
</script>
<template>
    <Head title="Incidencias"/>
    
    <AdminLayout>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        PANEL DE INCIDENCIAS
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <Table>
                <template #header>
                    <TableRow>
                        <TableHeaderCell>Equipo</TableHeaderCell>
                        <TableHeaderCell>Estado</TableHeaderCell>
                        <TableHeaderCell>Nivel</TableHeaderCell>
                        <TableHeaderCell>Evidencia</TableHeaderCell>
                        <TableHeaderCell>User</TableHeaderCell>
                        <TableHeaderCell>Etiqueta</TableHeaderCell>
                    </TableRow>
                </template>
                <template #default>
                    <TableRow v-for="inc in incidencias" :key="inc.id" class="border-b">
                        <TableDataCell >{{ inc.equipo.marca }}</TableDataCell>
                        <TableDataCell >{{ inc.estado }}</TableDataCell>
                        <TableDataCell >{{ inc.nivel }}</TableDataCell>
                        <TableDataCell >{{ inc.evidencia }}</TableDataCell>
                        <TableDataCell class="flex">
                            <div class="relative h-10 w-10">
                                <img class="h-full w-full rounded-full object-cover object-center"
                                    :src="inc.user.profile_photo_url" alt=""/>
                                <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                            </div>
                            <div class="text-sm ml-1">
                                <div class="font-medium text-gray-700">{{ inc.user.name }} - {{ inc.user.perfil?inc.user.perfil.apellidos:'' }}</div>
                                <div class="text-gray-400">{{ inc.user.email }}</div>
                            </div>
                        </TableDataCell>
                        <TableDataCell >{{ inc.etiqueta.nombre }}</TableDataCell>
                        <!-- <TableDataCell v-if="role.id != 1" class="space-x-4">
                            <Link
                            :href="route('admin.roles.edit', role.id)"
                            class="text-green-400 hover:text-green-600"
                            >Edit</Link
                            >
                            <button
                            @click="confirmDeleteRole"
                            class="text-red-400 hover:text-red-600"
                            >
                            Delete
                            </button>
                            <Modal :show="showConfirmDeleteRoleModal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-slate-800">
                                Are you sure to delete this Role?
                                </h2>
                                <div class="mt-6 flex space-x-4">
                                <DangerButton @click="deleteRole(role.id)">Delete</DangerButton>
                                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                </div>
                            </div>
                            </Modal>
                        </TableDataCell> -->
                    </TableRow>
                </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>