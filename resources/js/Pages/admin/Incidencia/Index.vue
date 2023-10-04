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
import { usePermission } from "@/composables/permissions";


const displayingToken = ref(false);
const props = defineProps({
    incidencias: Object,
    estados: Object,
});

const { hasPermission } = usePermission();

const form = useForm({
    _method: 'PUT',
    estado: "",
    evidencia: null,
    descripcion: "",
});
const itemdatos = ref(null);

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

const id = ref();
const tablekeysheaders= ref({
      'id':'ID','estado':'Estado','nivel':'Nivel','user.perfil.nombre':'Usuario','etiqueta.nombre|extraetiqueta':'Incidencia',
    }
);


const customClassColum= ref({
        'estado': {
            'Incidencia': "rounded-full bg-yellow-100 px-2 py-1 font-semibold text-yellow-600 border-2 border-yellow-600 dark:bg-gray-700 dark:text-yellow-400",
            'Suspendido': "rounded-full bg-red-100 px-2 py-1 font-semibold text-red-600 border-2 border-red-600 dark:bg-gray-700 dark:text-red-400",
            'Pendiente': "rounded-full bg-blue-100 px-2 py-1 font-semibold text-blue-600 border-2 border-blue-600 dark:bg-gray-700 dark:text-blue-400",
            'Solucionado': "rounded-full bg-green-100 px-2 py-1 font-semibold text-green-600 border-2 border-green-600 dark:bg-gray-700 dark:text-green-400",
        },
        'nivel': {
            'No urgente': "rounded-full bg-yellow-100 px-2 py-1 font-semibold text-yellow-600 border-2 border-yellow-600 dark:bg-yellow-900 dark:text-yellow-200",
            'Urgente':"rounded-full bg-red-100 px-2 py-1 font-semibold text-red-600 border-2 border-red-600 dark:bg-red-900 dark:text-red-200"
        },
    }
);

const customButtons= ref([{
        label: "Resolver",
        action: 'editar',
        novercondición:{'estado':'Solucionado'},
        permisos: hasPermission('incidencia resolver'),
        buttonClasses: "px-2 py-1 text-sm rounded-md bg-green-500 text-white hover:bg-green-600",
    },
    {
        label: "Ver información",
        action: 'eliminar',
        permisos: true,
        buttonClasses: "px-2 py-1 border-2 text-sm rounded-md text-white hover:bg-gray-600",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);
const tableFiltros= ref([
    {
        label: "Incidencias",
        key: "estado",
        val: "Incidencia",
    },
    {
        label: "Pendientes",
        key: "estado",
        val: "Pendiente",
    },
    {
        label: "Suspendidos",
        key: "estado",
        val: "Suspendido",
        active: true,
    },
    {
        label: "Solucionados",
        key: "estado",
        val: "Solucionado",
    },
]);

const showModel = ref(false);
const showDataModel = ref(false);

const closeModal = () => {
  showModel.value = false;
  photoPreview.value = null;
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

const showData = (val) => {
    showDataModel.value=true;
    itemdatos.value = props.incidencias.find(incidencia => incidencia.id === val); // para buscar un dato por su id
}

const closeDataModal = () => {
    showDataModel.value = false;
};



const save = () => {
    form.post(route('admin.incidencias.crearResuelto', id.value), {
          onSuccess: () => {
              closeModal()
          },
      });
    // form.post(route('admin.incidencias.update', id.value), {
    //     onSuccess: () => {
    //         form.get(route('admin.incidencias.update', id.value));
    //         closeModal()
    //     },
    // });
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

const formattedDate = (dat) => {
    const dateObject = new Date(dat);
    const options = {
        day: '2-digit',
        month: '2-digit',
        year: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
    };
    return dateObject.toLocaleDateString('es-PE', options);
};
</script>
<template>
    <Head title="Incidencias"/>
    
    <AdminLayout>
        <div class="py-4" v-if="hasPermission('incidencia index')">
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
            <div class="mt-6">
                <DataTable
                    :numerarRow="true"
                    :table-keys-headers="tablekeysheaders" 
                    :tableData="incidencias"
                    :custom-class-colum="customClassColum"
                    :customButtons="customButtons"
                    :tableFiltros="tableFiltros"
                    @editar="FormStore"
                    @eliminar="showData"
                    />
                  <Table></Table>
            </div>
        </div>
        <div>
            <Modal :show="showDataModel" @close="closeDataModal" maxWidth="5xl">
                <div class="p-4 bg-gray-100 flex items-center justify-center">
                    <div class="container max-w-screen-lg mx-auto">
                      <div>
                        <h2 class="font-semibold text-xl text-gray-600">Detalles de la Incidencia</h2>
                  
                        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                              <p class="font-medium text-lg">Evidencia</p>
                              <!-- <p>Please fill out all the fields.</p> -->

                              <div class="flex w-full justify-center"> 
                                <figure class="h-auto max-w-lg transition-all duration-300 rounded-lg cursor-pointer filter grayscale hover:grayscale-0">
                                    <!-- <a href="#"> -->
                                      <img class="rounded-lg" :src="itemdatos.evidencia" alt="image description">
                                    <!-- </a> -->
                                    <!-- <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                        <p>Do you want to get notified when a new component is added to Flowbite?</p>
                                    </figcaption> -->
                                  </figure>
                              </div>
                              <div class="text-justify">
                                Descripción: 
                                <p>{{itemdatos.descripcion}}</p>
                              </div>
                            </div>
                  
                            <div class="lg:col-span-2">
                              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                  <label for="full_name">Nombre se usuario </label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.user.name }} {{ itemdatos.user.perfil.apellidos }}</div>
                                </div>
                  
                                <div class="md:col-span-5">
                                  <label for="email">Incidencia</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.etiqueta? itemdatos.etiqueta.nombre: itemdatos.extraetiqueta }}</div>
                                </div>
                  
                                <div class="md:col-span-3">
                                  <label for="address">Nivel</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.nivel }}</div>
                                </div>
                  
                                <div class="md:col-span-2">
                                  <label for="city">Fecha</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ formattedDate(itemdatos.created_at) }}</div>
                                </div>

                                <div class="md:col-span-3">
                                  <label for="address">Equipo</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.equipo.marca }}</div>
                                </div>
                  
                                <div class="md:col-span-2">
                                  <label for="city">IP:</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.equipo.ip }}</div>
                                </div>

                                <div class="md:col-span-3">
                                  <label for="address">Oficina</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.equipo.oficina.nombre }}</div>
                                </div>
                  
                                <div class="md:col-span-2">
                                  <label for="city">Sede:</label>
                                  <div class="p-2 border mt-1 items-center rounded px-4 w-full bg-gray-50">{{ itemdatos.equipo.oficina.sede.nombre }}</div>
                                </div>
                  
                                <!-- <div class="md:col-span-2">
                                  <label for="country">Country / region</label>
                                  <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <input name="country" id="country" placeholder="Country" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                    <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                      </svg>
                                    </button>
                                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                    </button>
                                  </div>
                                </div>
                  
                                <div class="md:col-span-2">
                                  <label for="state">State / province</label>
                                  <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                    <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                      </svg>
                                    </button>
                                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                      <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                    </button>
                                  </div>
                                </div>
                  
                                <div class="md:col-span-1">
                                  <label for="zipcode">Zipcode</label>
                                  <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
                                </div>
                  
                                <div class="md:col-span-5">
                                  <div class="inline-flex items-center">
                                    <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                                    <label for="billing_same" class="ml-2">My billing address is different than above.</label>
                                  </div>
                                </div>
                  
                                <div class="md:col-span-2">
                                  <label for="soda">How many soda pops?</label>
                                  <div class="h-10 w-28 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-r border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                    <input name="soda" id="soda" placeholder="0" class="px-2 text-center appearance-none outline-none text-gray-800 w-full bg-transparent" value="0" />
                                    <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-500 hover:text-blue-600">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                      </svg>
                                    </button>
                                  </div>
                                </div> -->
                        
                                <div class="md:col-span-5 text-right lg:mt-16">
                                    <SecondaryButton @click="closeDataModal">Cerrar</SecondaryButton>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
            </Modal>
        </div>
    </AdminLayout>
</template>