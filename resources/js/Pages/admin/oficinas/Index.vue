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
    {
        label: "Ver Detalles",
        action: 'detalles',
        permisos: true,
        buttonClasses: "px-2 py-1 border-2 text-sm bg-gray-200 rounded-md hover:bg-gray-300 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-600",
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
const showDataModel = ref(false);
const datos = ref(null);
const verDetalles = (id) =>{
    showDataModel.value=true;
    datos.value = props.oficinas.find(incidencia => incidencia.id === id); // para buscar un dato por su id
    console.log(datos.value);
}
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
          @detalles="verDetalles"
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

    <Modal :show="showDataModel" @close="showDataModel = false" maxWidth="5xl">
      <div class="p-4 bg-gray-100 flex items-center justify-center">
          <div class="container max-w-screen-lg mx-auto">
            <div>
              <h2 class="font-semibold text-xl text-gray-600">Detalles de la Incidencia</h2>
              <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                  <div class="text-gray-600 lg:col-span-2">
                    <p class="font-medium text-lg">{{ datos.nombre }}</p>
                    <div class="flex w-full justify-center space-x-4"> 
                      <div class="md:col-span-5">
                        <label>Equipos</label>
                        <div v-if="!datos.equipos[0]" class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50"> Sin Equipos </div>
                        <div v-for="equ in datos.equipos" class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">
                            {{ equ.tipo_equipo }} - {{ equ.marca }} - {{ equ.ip }}
                        </div>
                      </div>
                      <div class="md:col-span-5">
                        <label>Usuarios</label>
                        <div v-if="!datos.perfils[0]" class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">* Sin Usuarios</div>
                        <div v-for="per in datos.perfils" class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">
                            {{ per.nombre }} {{ per.apellidos }}
                        </div>
                      </div>
                    </div>
                  </div>
        
                  <div class="lg:col-span-1">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                      <div class="md:col-span-5">
                        <label>Sede:</label>
                        <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">
                          {{ datos.sede.nombre }}
                        </div>
                      </div>
                      <div class="md:col-span-5">
                        <label>Direccion:</label>
                        <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">
                          {{ datos.sede.direccion }}
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="md:col-span-5 text-right lg:mt-4">
                          <SecondaryButton @click="showDataModel = false">Cerrar</SecondaryButton>
                      </div>
              </div>
              
            </div>
            
          </div>
        </div>
      </Modal>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
