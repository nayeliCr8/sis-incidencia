<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableRow from '@/Components/TableRow.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    equipos: Object
});


</script>

<template>
    <Head title="Equipos"/>
    <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
        <div class="flex justify-end mr-6">
            <SecondaryButton @click="FormStore">Registrar Equipo</SecondaryButton>
        </div>
        <div class="mt-6">
            <Table>
                <template #header>
                    <TableRow>
                        <TableHeaderCell>Marca</TableHeaderCell> 
                        <TableHeaderCell>Serie</TableHeaderCell> 
                        <TableHeaderCell>Ip</TableHeaderCell> 
                        <TableHeaderCell>Estado</TableHeaderCell> 
                        <TableHeaderCell>Tipo</TableHeaderCell> 
                        <TableHeaderCell>Oficina</TableHeaderCell> 
                        <TableHeaderCell>Acciones</TableHeaderCell> 
                    </TableRow> 
                </template>
                <template #default>
                    <TableRow v-for="equipo in equipos" :key="equipo.id">
                        <TableDataCell class="space-x-4">{{ equipo.marca }}</TableDataCell>
                        <TableDataCell class="space-x-4">{{ equipo.serie }}</TableDataCell>
                        <TableDataCell class="space-x-4">{{ equipo.ip }}</TableDataCell>
                        <TableDataCell class="space-x-4">{{ equipo.estado }}</TableDataCell>
                        <TableDataCell class="space-x-4">{{ equipo.tipo_equipo }}</TableDataCell>
                        <TableDataCell class="space-x-4">{{ equipo.oficina.nombre }}</TableDataCell>
                        <TableDataCell class="space-x-4">Editar/Eliminar</TableDataCell>
                    </TableRow>
                </template>
            </Table>
        </div>
    </div>
    </AdminLayout>
</template>


<style lang="scss" scoped>

</style>