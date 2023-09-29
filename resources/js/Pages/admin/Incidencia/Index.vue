<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";

import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";

import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from "vue";
import DataTable from "@/Components/MyComponents/DataTable2.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const displayingToken = ref(false);
const props = defineProps({
    incidencias: Object,
});

console.log(props.incidencias[0]);
const form = useForm({});

const tablekeysheaders= ref({
        'estado':'Estado','nivel':'Nivel','user.perfil.nombre':'Usuario','etiqueta.nombre':'Etiqueta'
    }
);
const customClassColum= ref({
        'estado': {
            'Incidencia': "px-2 py-1 text-sm rounded-md bg-yellow-500 text-white hover:bg-yellow-600",
            'Suspendido': "px-2 py-1 text-sm rounded-md bg-red-500 text-white hover:bg-red-600",
            'Pendiente': "px-2 py-1 text-sm rounded-md bg-blue-500 text-white hover:bg-blue-600",
            'Solucionado': "px-2 py-1 text-sm rounded-md bg-green-500 text-white hover:bg-green-600",
        },
        'nivel': {
            'No urgente': "px-2 py-1 text-sm rounded-md bg-yellow-500 text-white hover:bg-yellow-600",
            'Urgente':"px-2 py-1 text-sm rounded-md bg-red-500 text-white hover:bg-red-600"
        },
    }
);
const customButtons= ref([{
        label: "Editar",
        action: 'editar',
        buttonClasses: "px-2 py-1 text-sm rounded-md bg-green-500 text-white hover:bg-green-600",
    },
    {
        label: "Eliminar",
        action: 'eliminar',
        buttonClasses: "px-2 py-1 text-sm rounded-md bg-red-500 text-white hover:bg-red-600",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);
const edit=(val)=>{
    const item = props.incidencias.find(incidencia => incidencia.id === val); // para buscar un dato por su id
    console.log(item);
    form.put(route('admin.incidencia.update',val));
} 
const eli=(val)=>{
    console.log('tengo q eliminar');
    console.log(val);
}

const showModel = ref(false);

const FormStore = (val) => {
  showModel.value = true;
  const item = props.incidencias.find(incidencia => incidencia.id === val); // para buscar un dato por su id
    console.log(item);
};


const closeModal = () => {
  showModel.value = false;
  form.reset();
};
</script>
<template>
    <Head title="Incidencias"/>
    
    <AdminLayout>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mr-6">
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
                        </div>
                      </div>
                    </Modal>
                  </div>
            </div>
            <SecondaryButton @click="displayingToken = true">
                Abrir
            </SecondaryButton>
            <div class="mt-6">
                <DataTable
                    :numerarRow="true"
                    :table-keys-headers="tablekeysheaders" 
                    :tableData="incidencias"
                    :custom-class-colum="customClassColum"
                    :customButtons="customButtons"
                    @editar="FormStore"
                    @eliminar="eli"
                    />
            </div>
        </div>

        <DialogModal :show="displayingToken" @close="displayingToken = false" max-width="6xl">
            <template #title>
                API Token
            </template>

            <template #content>
                <div>
                    Please copy your new API token. For your security, it won't be shown again.
                </div>
                <DataTable 
                    :table-keys-headers="{'id':'ID','estado':'Estado','nivel':'Nivel','user.perfil.nombre':'Usuario','etiqueta.nombre':'Etiqueta'}" 
                    :tableData="incidencias"
                    />
            </template>

            <template #footer>
                <SecondaryButton @click="displayingToken = false">
                    Close
                </SecondaryButton>
            </template>
        </DialogModal>
    </AdminLayout>
</template>