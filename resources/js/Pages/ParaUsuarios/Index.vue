<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import CardEquipo from '@/Components/MyComponents/CardEquipo.vue';
import { ref } from 'vue';

const props = defineProps({
    usuario: Object,
});
const datoskeysheaders= ref({
        'marca':'Marca','serie':'Serie','ip':'IP','estado':'Estado'
    }
);

const func = (id)=>{
    console.log(id);
}
// console.log(props.usuario);
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
    </AppLayout>
</template>
