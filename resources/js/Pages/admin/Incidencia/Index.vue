<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head} from "@inertiajs/vue3";

import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";

import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from "vue";
import DataTable from "@/Components/MyComponents/DataTable2.vue";

const displayingToken = ref(false);
const props = defineProps({
    incidencias: Object,
});

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
} 
const eli=(val)=>{
    console.log('tengo q eliminar');
    console.log(val);
}
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
                <!-- <div v-for="da,index in incidencias" :key="index">
                    <div>{{ da }}</div>
                </div> -->
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
                    @editar="edit"
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