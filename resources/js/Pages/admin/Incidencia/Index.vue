<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head, useForm, router } from "@inertiajs/vue3";

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
import InputError from "@/Components/InputError.vue";
const displayingToken = ref(false);
const props = defineProps({
    incidencias: Object,
    estados: Object,
});

const form = useForm({
    _method: 'PUT',
    estado: "",
    evidencia: null,
    descripcion: "",
});
const photoInput = ref(null);
const photoPreview = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};
console.log(props.incidencias[0]);

const id = ref();
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
        label: "Resolver",
        action: 'editar',
        buttonClasses: "px-2 py-1 text-sm rounded-md bg-green-500 text-white hover:bg-green-600",
    },
    {
        label: "Ver información",
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

const closeModal = () => {
  showModel.value = false;
  form.reset();
};


const FormStore = (val) => {
  showModel.value = true;
    const item = props.incidencias.find(incidencias => incidencias.id === val); // para buscar un dato por su id
    id.value = item.id;
    form.estado = item.estado;
    form.evidencia = "",
    form.descripcion = "",
    console.log(item.id);
};

const save = () => {
    form.post(route('admin.incidencias.update', id.value), {
        onSuccess: () => {
            form.get(route('admin.incidencias.update', id.value));
            closeModal()
        },
    });
};



const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const test = (e) => {
    // console.log();
    form.evidencia = e.target.files[0];
    //.target.files[0]
}
</script>
<template>
    <Head title="Incidencias"/>
    
    <AdminLayout>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mr-6">
                    <!-- <h1>Users Index Page</h1> -->
                    <!-- <SecondaryButton @click="FormStore">Registrar Sede</SecondaryButton> -->
                    <Modal :show="showModel" @close="closeModal">
                      <div class="p-4">
                        <div class="mb-6">
                            <InputLabel>Estado</InputLabel>
                            <select v-model="form.estado" id="estado" name="estado" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                              <option v-for="estado in estados" :key="estado.id">
                                {{ estado }}
                              </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.estado" />
                        </div>
                        <div class="mb-6">
                          <InputLabel>Evidencia</InputLabel>
                          <input
                          ref="photoInput"
                          type="file"
                          class="hidden"
                          @input="test"
                          @change="updatePhotoPreview"
                      >
      
                      <InputLabel for="photo" value="Photo" />
      
                      <!-- Current Profile Photo -->
                      <!-- <div v-show="! photoPreview" class="mt-2">
                          <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                      </div> -->
      
                      <!-- New Profile Photo Preview -->
                      <div v-show="photoPreview" class="mt-2">
                          <span
                              class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                              :style="'background-image: url(\'' + photoPreview + '\');'"
                          />
                      </div>
      
                      <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                          Select A New Photo
                      </SecondaryButton>
                          <!-- <TextInput class="w-full" v-model="form.evidencia"></TextInput> -->
                          <InputError class="mt-2" :message="form.errors.evidencia" />
                        </div>
                        <div class="mb-6">
                            <InputLabel>Descripción</InputLabel>
                            <textarea
                              class="w-full rounded dark:bg-gray-800 text-white"
                              rows="5"
                              v-model="form.descripcion"
                            />
                            <InputError class="mt-2" :message="form.errors.descripcion" />
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