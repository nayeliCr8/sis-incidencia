<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CardEquipo from '@/Components/MyComponents/CardEquipo.vue';
import InputImage from '@/Components/MyComponents/InputImage.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    usuario: Object,
    etiquetas: Object,
});

const vermodal = ref(false);
const val_etiqueta = ref('');
const datoskeysheaders= ref({
        'marca':'Marca','serie':'Serie','ip':'IP','estado':'Estado'
    }
);
const form = useForm({
    equipo_id:null,
    etiqueta_id: val_etiqueta.value,
    otros: false,
    evidencia: null,
    descripcion: null,
});
const verotros = ()=>{
    if(val_etiqueta.value === 'otros'){
        form.otros=true;
    }else{
        form.otros=false;
        form.etiqueta_id=val_etiqueta.value;
    }
}
const func = (id)=>{
    form.equipo_id = id;
    vermodal.value = true;
}
const closeModal = () => {
    vermodal.value = false;
    form.reset();
};
const save = () => {
    form.post(route('parauser.store'),{
        onSuccess: () =>{
            closeModal();
        }
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Mis Equipos de Oficina
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <Welcome /> -->
                    <div class="grid w-full lg:grid-cols-3 sm:grid-cols-2 p-4 justify-center">
                        <CardEquipo v-for="eq,i in usuario[0].perfil.oficina.equipos" :key="i" 
                            :tipo="eq.tipo_equipo"
                            :titulo="eq.tipo_equipo"
                            :datos="eq"
                            :datosKeysHeaders="datoskeysheaders"
                            @editar="func">
                            Reportar
                        </CardEquipo>
                    </div> 
                </div>
            </div>
        </div>
        <DialogModal :show="vermodal" @close="closeModal" max-width="2xl">
            <template #title>
                Reportar Incidencia
            </template>
            <template #content>
                <div class="p-4">
                    <div class="mb-6">
                        <InputLabel>Que incidencia encontro?</InputLabel>
                        <select @change="verotros" v-model="val_etiqueta" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" selected disabled>-- Seleccione --</option>
                            <option v-for="eti in etiquetas" :key="eti.id" :value="eti.id">{{ eti.nombre }}</option>
                            <option value="otros">Otros</option>
                        </select>
                        <TextInput v-if="form.otros" v-model="form.etiqueta_id" class="w-full mt-4"></TextInput>
                        <InputError class="mt-2" :message="form.errors.etiqueta_id" />
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
                    <div class="mb-6">
                        <InputLabel for="photo" value="Evidencia"/>
                        <InputImage v-model="form.evidencia"/>
                        <InputError class="mt-2" :message="form.errors.evidencia" />
                    </div>
                </div>
            </template>

            <template #footer>
                <div class="space-x-4">
                    <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                    <PrimaryButton @click="save" >Registrar</PrimaryButton>
                </div>
            </template>
        </DialogModal>
    </AppLayout>
</template>