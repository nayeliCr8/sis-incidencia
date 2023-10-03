<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { usePermission } from "@/composables/permissions";
const props = defineProps({
  sedes: Object,
});

const id = ref();
const option = ref(1)
// const nombre = ref();
// const direccion = ref();
const { hasPermission } = usePermission();

const form = useForm({
  nombre: '',
  direccion: '',
  errors: '',
});
const showModel = ref(false);

const FormStore = () => {
  showModel.value = true;
};


const closeModal = () => {
  showModel.value = false;
  form.reset();
};
const FormUpdate = (opt,op) => {
    showModel.value = true;
    option.value = opt;
    id.value = op.id;
    form.nombre = op.nombre;
    form.direccion = op.direccion;
}

const save = () => {
    if(option.value == 1){
        form.post(route("admin.sedes.store"), {
            onSuccess: () => closeModal(),
        });
    }else{
        form.put(route("admin.sedes.update", id.value), {
            onSuccess: () => closeModal(),
        });
    }
}
// const formUpdate = () => {
   
// }

// const deleteUser = (id) => {
//    form.delete(route('admin.users.destroy', id), {
//     onSuccess: () => closeModal()
//    });
// }
// const formStore = () => {
  
// };
</script>
<template>
  <Head title="Dashboard" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end mr-6" v-if="hasPermission('sede create')">
        <!-- <h1>Users Index Page</h1> -->
        <SecondaryButton @click="FormStore">Registrar Sede</SecondaryButton>
        <Modal :show="showModel" @close="closeModal">
          <div class="p-4">
            <div class="mb-6">
              <InputLabel>Nombre</InputLabel>
              <TextInput class="w-full" v-model="form.nombre"></TextInput>
              <InputError class="mt-2" :message="form.errors.nombre" />
            </div>
            <div class="mb-6">
              <InputLabel>Dirección</InputLabel>
              <TextInput class="w-full" v-model="form.direccion"></TextInput>
              <InputError class="mt-2" :message="form.errors.direccion" />
            </div>
            <div class="mt-6 flex space-x-4 justify-end">
              <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
              <PrimaryButton @click="save()">Registrar</PrimaryButton>
              <!-- <PrimaryButton @click="formUpdate()">Actualizar</PrimaryButton> -->
            </div>
          </div>
        </Modal>
      </div>
      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>Nombre</TableHeaderCell>
              <TableHeaderCell>Dirección</TableHeaderCell>
              <template v-if="hasPermission('sede update','sede delete')">
                <TableHeaderCell>Action</TableHeaderCell>
              </template>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="sede in sedes" :key="sede.id" class="border-b">
              <TableDataCell class="space-x-4">{{ sede.nombre }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ sede.direccion }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <template v-if="hasPermission('sede update')">
                  <PrimaryButton @click="FormUpdate(0,sede)">Editar</PrimaryButton>
                </template>
                <template v-if="hasPermission('sede delete')">
                  <Link
                    :href="route('admin.sedes.destroy', sede.id)"
                    method="delete"
                    as="button"
                    type="button"
                    class="font-medium text-red-500 hover:text-red-700 mr-2"
                    >Delete</Link
                  >
                </template>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
