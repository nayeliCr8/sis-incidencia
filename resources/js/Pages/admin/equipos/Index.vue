<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableRow from "@/Components/TableRow.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

const props = defineProps({
  equipos: Object,
});

const showModel = ref(false);

const FormStore = () => {
  showModel.value = true;
};

const closeModal = () => {
  showModel.value = false;
};
</script>

<template>
  <Head title="Equipos" />
  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end mr-6">
        <SecondaryButton @click="FormStore">Registrar Equipo</SecondaryButton>
        <Modal :show="showModel" @close="closeModal">
          <div class="p-4">
            <div class="mb-6">
              <InputLabel>Marca</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Serie</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Protocolo de Internet (IP)</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Estado</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Observación</InputLabel>
              <textarea class="w-full rounded" rows="5" v-model="gdgfdg"/>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Tipo de equipo</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Oficina</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mt-6 flex space-x-4 justify-end">
              <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
              <SecondaryButton @click="save">Registrar</SecondaryButton>
            </div>
          </div>
        </Modal>
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

<style lang="scss" scoped></style>
