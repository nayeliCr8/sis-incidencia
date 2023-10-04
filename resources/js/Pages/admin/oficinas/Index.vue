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
import DataTable from "@/Components/MyComponents/DataTable2.vue";
const props = defineProps({
  oficinas: Object,
  sedes: Object,
});

const {hasPermission} = usePermission();


const tablekeysheaders= ref({
     'nombre':'Nombre de la Oficina','sede.nombre':'Nombre de la Sede'
    }
);

const customButtons= ref([{
        label: "Editar",
        action: 'editar',
        permisos: hasPermission('oficina update'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    {
        label: "Eliminar",
        action: 'eliminar',
        permisos: hasPermission('oficina delete'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);

const tableFiltros= ref([]);

const llave = ref();
const option = ref(1)
const data = ref();

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
const FormUpdate = (id) => {
    showModel.value = true;
    data.value = props.oficinas.find(oficina => oficina.id === id); // para buscar un dato por su id
    form.nombre = data.value.nombre;
    form.sede = data.value.sede.id;
    option.value = 0;
    llave.value = data.value.id;
}

const save = () => {
    if(option.value == 1){
        form.post(route("admin.oficinas.store"), {
            onSuccess: () => closeModal(),
        });
    }else{
        form.put(route("admin.oficinas.update", llave.value), {
            onSuccess: () => closeModal(),
        });
    }
}

const deleteOficina = (id) => {
   form.delete(route('admin.oficinas.destroy', id), {
    onSuccess: () => closeModal()
   });
}
  
// };
</script>
<template>
  <Head title="Dashboard" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end" v-if="hasPermission('oficina create')">
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
            </div>
          </div>
        </Modal>
      </div>
      <div class="mt-6">
        <DataTable
        :numerarRow="true"
        :table-keys-headers="tablekeysheaders" 
        :tableData="oficinas"
        :customButtons="customButtons"
        :tableFiltros="tableFiltros"
        @editar="FormUpdate"
        @eliminar="deleteOficina"
        />
        <!-- <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>Id</TableHeaderCell>
              <TableHeaderCell>Oficina</TableHeaderCell>
              <TableHeaderCell>Sede</TableHeaderCell>
              <TableHeaderCell>Personal</TableHeaderCell>
              <TableHeaderCell>Equipos</TableHeaderCell>
              <template v-if="hasPermission('oficina update', 'oficina delete')">
                <TableHeaderCell>Action</TableHeaderCell>
              </template>
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
                <template v-if="hasPermission('oficina update')">
                  <PrimaryButton @click="FormUpdate(0,oficina)">Editar</PrimaryButton>
                </template>
                <template v-if="hasPermission('oficina delete')">
                  <Link
                    :href="route('admin.oficinas.destroy', oficina.id)"
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
        </Table> -->
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
