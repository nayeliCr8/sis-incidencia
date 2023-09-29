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
const props = defineProps({
  oficinas: Object,
  sedes: Object,
});

console.log(props.oficinas);

const id = ref();
const option = ref(1)
// const nombre = ref();
// const sede = ref();

const form = useForm({
  nombre: '',
  sede: '',
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
    form.sede = op.sede.id;
}

const save = () => {
    if(option.value == 1){
        form.post(route("admin.oficinas.store"), {
            onSuccess: () => closeModal(),
        });
    }else{
        form.put(route("admin.oficinas.update", id.value), {
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
      <div class="flex justify-end mr-6">
        <!-- <h1>Users Index Page</h1> -->
        <SecondaryButton @click="FormStore">Registrar Oficina</SecondaryButton>
        <Modal :show="showModel" @close="closeModal">
          <div class="p-4">
            <div class="mb-6">
              <InputLabel>Nombre</InputLabel>
              <TextInput class="w-full" v-model="form.nombre"></TextInput>
              <InputError class="mt-2" :message="form.errors.nombre" />
            </div>
            <div class="mb-6">
                <InputLabel>Sede</InputLabel>
                <select
              v-model="form.sede"
              id="sede"
              name="sede"
              class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm
              "
            >
              <option
                v-for="sede in sedes"
                :key="sede.id"
                :value="sede.id"
              >
                {{ sede.nombre }}
              </option>
            </select>
                <InputError class="mt-2" :message="form.errors.sede" />
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
              <TableHeaderCell>Id</TableHeaderCell>
              <TableHeaderCell>Oficina</TableHeaderCell>
              <TableHeaderCell>Sede</TableHeaderCell>
              <TableHeaderCell>Personal</TableHeaderCell>
              <TableHeaderCell>Equipos</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="oficina in oficinas" :key="oficina.id" class="border-b">
              <TableDataCell class="space-x-4">{{ oficina.id }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ oficina.nombre }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ oficina.sede.nombre }}</TableDataCell>
              <TableDataCell >
                <div v-for="per,ind in oficina.perfils" :key="ind">
                  {{ per.nombre }}
                </div> 
              </TableDataCell>
              <TableDataCell >
                <div v-for="eq,ind in oficina.equipos" :key="ind">
                  {{ eq.tipo_equipo }}
                </div> 
              </TableDataCell>
              <TableDataCell class="space-x-4">

                <PrimaryButton @click="FormUpdate(0,oficina)">Editar</PrimaryButton>
                <!-- <Link
                  :href="route('admin.sedes.edit', sede.id)"
                  class="text-green-400 hover:text-green-600"
                  >Edit</Link
                > -->
                <Link
                  :href="route('admin.oficinas.destroy', oficina.id)"
                  method="delete"
                  as="button"
                  type="button"
                  class="font-medium text-red-500 hover:text-red-700 mr-2"
                  >Delete</Link
                >
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
