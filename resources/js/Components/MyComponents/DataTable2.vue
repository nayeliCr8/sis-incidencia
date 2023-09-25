<script setup>
import { computed, defineEmits , onMounted, reactive, ref, watch, watchEffect } from 'vue';
// Define una referencia para guardar las emisiones
const emit = defineEmits(['editar', 'eliminar']);

const props = defineProps({
    tableKeysHeaders: { // contiene las llaves y cabeceras
        type: Object,
        required: true,
    },
    tableData: { // contiene los datos
        type: Object,
        required: true,
    },
    perPage: { // contiene la cantida de elemtos por pagina
        type: Number,
        default: 10,
    },
    customClassColum: { // contiene a los botones
        type: Object,
        default: null,
    },
    customButtons: { // contiene a los botones
        type: Array,
        default: null,
    },
    numerarRow:{ // contiene el valor si se dea mostrar contador de filas
        type: Boolean,
        default: false,
    },
    acctions:{ // contiene un arra de acciones para los botones
        type: Array,
    }
});
// Metodo para los botones que recibe la accion y el id de la fila
const handleCustomButtonClick = (action, idcolun) => {
  // Emitir la acción
  emit(action, idcolun);
};
// Metodo para comvertir la Data en un array plano
const convertDataToSimpleArray = (data, columnConfig) => {
  const simpleArray = [];
  data.forEach((item) => {
    const row = {};
    row['__id__']=item['id'];
    for (const configKey in columnConfig) {
        let value = null;
        if (configKey.includes('.')) {
            const keys = configKey.split('.'); // Dividir la clave por puntos
            value = item;
            // Recorrer las claves para acceder a las propiedades anidadas
            for (const key of keys) {
                if (value.hasOwnProperty(key)) {
                    value = value[key];
                } else {
                    value = null; // Si no existe la propiedad, asignar null
                    break;
                }
            }
        }else{
            value = item[configKey];
        }
        // Agregar al objeto de fila
        row[configKey] = value;
    }
    simpleArray.push(row);
  });
  return simpleArray;
};
const _tableData = convertDataToSimpleArray(props.tableData,props.tableKeysHeaders); //aqui cramos la Data plana
let len_table = ref(props.tableData.length);  // tamaño de la data
const searchQuery = ref(''); // referencia para busqueda
const currentPage = ref(1);  // Definir una referencia reactiva para la página actual
// Calcular el índice de inicio y final de los elementos a mostrar en la página actual
const startIndex = computed(() => (currentPage.value - 1) * props.perPage);
let endIndex = computed(() => Math.min(startIndex.value + props.perPage, len_table.value));

let columnSearchInputs = ref({}); // referencia para almacenar los términos de búsqueda de cada columna
let openSearchColumns = ref({}); // referencia para rastrear qué columnas tienen el cuadro de búsqueda abierto
let searchInputRefs = reactive({}); //referncia pra realizar focus en los inputs de busqueda por columna
// Inicializar columnSearchInputs y openSearchColumns
for (const configKey in props.tableKeysHeaders) {
    columnSearchInputs.value[configKey] = '';
    openSearchColumns.value[configKey] = false;
}
// Dato para la llave del dato y direccion para ordenar
const sortConfig = ref({
    key: '',        // La clave de la columna por la que se está ordenando
    direction: ''   // La dirección de ordenamiento: 'asc' o 'desc'
});
watch(searchQuery, (newSearchQuery) => { // cuando exista cambio en el input de busqueda global
    currentPage.value = 1; // Establecer la página actual en 1 cuando hay cambio en searcjQuery
});
// Metodo para realizar los cambios de dirección del ordenamiento por columna
const sortByColumn = (key) => {
    if (sortConfig.value.key === key) {
        sortConfig.value.direction = sortConfig.value.direction === 'asc' ? 'desc' : 'asc';
    } else {
        sortConfig.value.key = key;
        sortConfig.value.direction = 'asc';
    }
    // Después de ordenar, establecer la página actual en 1
    currentPage.value = 1;
    // Restablecer el valor de búsqueda para la columna actual
    columnSearchInputs.value[key] = '';
};
// Calcular los datos paginados en función de la página actual y ordenamiento
const paginatedData = computed(() => {
    const dataCopy = [..._tableData];
    if (sortConfig.value.key && sortConfig.value.direction) {
        dataCopy.sort((a, b) => { // realizar el ordenamiento con sort
            const keyA = a[sortConfig.value.key];
            const keyB = b[sortConfig.value.key];
            // Usar isNumeric para determinar si los datos son numéricos
            const isNumeric = !isNaN(parseFloat(keyA)) && !isNaN(parseFloat(keyB));  //
            if (isNumeric) {
                // Comparación numérica
                return sortConfig.value.direction === 'asc' ? keyA - keyB : keyB - keyA;
            } else {
                // Comparación alfabética
                return sortConfig.value.direction === 'asc' ? keyA.localeCompare(keyB) : keyB.localeCompare(keyA);
            }
        });
    }
    // Filtrar los datos en función de la búsqueda global y la búsqueda en columnas
    const filteredData = dataCopy.filter(item => {
        const columnKey = Object.keys(columnSearchInputs.value).find(key => { // buscar en que columna tiene un valor para la busqueda
            return columnSearchInputs.value[key].toLowerCase() !== '';
        });
        if (searchQuery.value) { // para filtrado de forma global
            const globalSearchableFields = Object.values(item).join(' ').toLowerCase();
            return globalSearchableFields.includes(searchQuery.value.toLowerCase());
        } else if (columnKey) { // para filtrado por columnas
            const columnSearchInput = columnSearchInputs.value[columnKey].toLowerCase();
            const searchableField = item[columnKey].toString().toLowerCase();
            return searchableField.includes(columnSearchInput);
        } else {
            return true; // No hay búsquedas activas, mostrar todos los datos
        }
    });
    len_table.value = filteredData.length; // actualizamos el tamaño de datos
    return filteredData.slice(startIndex.value, endIndex.value);  //slice obtiene un parte del array copy
});
// Método para cambiar a la página anterior
const goToPrevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};
// Método para cambiar a la página siguiente
const goToNextPage = () => {
    if (endIndex.value < len_table.value) {
        currentPage.value++;
    }
};
// Calcular el número total de páginas
let totalPages = computed(() => {
    return Math.ceil(len_table.value / props.perPage);  //ceil redondea el valor
});
 
const abrirBusColum = (key) => {
    openSearchColumns.value[key] = !openSearchColumns.value[key];
    columnSearchInputs.value[key] = '';
    // Usar nextTick para enfocar el campo de búsqueda después de que se muestre
    watchEffect(() => {
        if (searchInputRefs[key]) {
            searchInputRefs[key].focus();
        }
    });
}
const limpiarFiltros = () => {
  Object.keys(columnSearchInputs.value).forEach(key => {
    columnSearchInputs.value[key] = '';
  });
};
const hayValorSearchInputs = computed(() => {
  // Utiliza la función some para verificar si al menos un valor no es una cadena vacía
  return Object.values(columnSearchInputs.value).some(value => value !== '');
})
</script>

<template>
  <section class="container mx-auto">
    <!-- Botones -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div class="flex items-center mt-4 gap-x-3">
            <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_3098_154395)">
                    <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_3098_154395">
                    <rect width="20" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <span>Import</span>
            </button>
            <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Add vendor</span>
            </button>
        </div>
    </div>
    <div class="mt-6 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                View all
            </button>
            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Monitored
            </button>
            <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Unmonitored
            </button>
            <span class="text-sm m-2 text-gray-800 dark:text-gray-300">{{ len_table }} Datos</span>
        </div>
        <div class="flex items-center">
            <button v-if="hayValorSearchInputs" @click="limpiarFiltros" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                <span>Limpiar Filtros</span>
            </button>
            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input v-model="searchQuery" type="text" placeholder="Buscar" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>
        
    </div>
    <!-- Tabla -->
    <div class="flex flex-col my-2">
        <div class="overflow-x-autol scroll-container">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th v-if="numerarRow" scope="col" class="relative py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    #
                                </th>
                                <th v-for="(header, _key) in tableKeysHeaders" :key="_key"
                                 scope="col" class="relative py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center mt-4 md:mt-0">
                                        <button @click="sortByColumn(_key)" class="flex items-center gap-x-3 focus:outline-none font-bold">
                                            <span class="font-bold">{{ header }}</span>
                                            <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <!-- Lógica para mostrar una flecha ascendente o descendente según el estado de ordenamiento -->
                                                <path v-if="sortConfig.key === _key && sortConfig.direction === 'asc'" 
                                                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" 
                                                    fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path v-else 
                                                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" 
                                                    fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                            </svg>
                                        </button>
                                        <button @click="abrirBusColum(_key)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div v-if="openSearchColumns[_key]" class="absolute" >
                                        <div class="relative w-4 flex items-center mt-4 md:mt-0">
                                            <span class="absolute">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                </svg>
                                            </span>
                                            <input v-model="columnSearchInputs[_key]" @blur="openSearchColumns[_key] = false;" :ref="el => searchInputRefs[_key] = el" type="text" :placeholder="'Buscar por '+header" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                        </div>
                                    </div>
                                </th>
                                <th v-if="customButtons" scope="col" class="relative py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex">
                                <td v-if="numerarRow" class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="text-gray-700 dark:text-gray-200">
                                        {{ (rowIndex + 1)+ perPage*(currentPage -1) }}
                                    </div>
                                </td>
                                <template v-for="(dat, _key) in row" :key="_key">
                                    <td v-if="_key!='__id__'" class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                        <div v-if="customClassColum && customClassColum[_key]">
                                            <span :class="customClassColum[_key][dat]"> {{ dat }} </span>
                                        </div>
                                        <div v-else class="text-gray-700 dark:text-gray-200">
                                            {{ dat }}
                                        </div>
                                    </td>
                                </template>
                                <!-- Columna para los botones personalizados -->
                                <td v-if="customButtons" class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <!-- Bucle para los botones personalizados -->
                                    <button v-for="(button, buttonIndex) in customButtons" :key="buttonIndex"
                                        @click="handleCustomButtonClick(button.action, row['__id__'])" class="mx-1"
                                        :class="button.buttonClasses || 'text-sm rounded-md bg-blue-500 text-white hover:bg-blue-600'"
                                    >
                                        {{ button.label }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Paginación -->
    <div class="flex items-center justify-between">
        <button @click="goToPrevPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            <span>Anterior</span>
        </button>
        <div class="items-center hidden md:flex gap-x-3">
            <!-- Lógica para generar los números de página -->
            <template v-if="totalPages <= 10">
                <template v-for="pageNumber in totalPages" :key="pageNumber">
                <button @click="currentPage = pageNumber" :class="['px-2 py-1 text-sm rounded-md', { 'bg-gray-800 border-2 border-gray-300 text-white font-bold': pageNumber === currentPage, 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-300 dark:bg-gray-500': pageNumber !== currentPage }]">{{ pageNumber }}</button>
                </template>
            </template>
            <template v-else>
                <!-- Mostrar el primer número -->
                <button @click="currentPage = 1" :class="['px-2 py-1 text-sm rounded-md', { 'bg-gray-800 border-2 border-gray-300 text-white font-bold': currentPage === 1, 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-300 dark:bg-gray-500': currentPage !== 1 }]">1</button>
                <!-- Mostrar "..." si hay números anteriores -->
                <span v-if="currentPage>4" class="px-2 py-1 text-sm rounded-md text-gray-500 dark:text-gray-200 dark:bg-gray-700">...</span>
                <!-- Mostrar 2 números anteriores y 2 números siguientes -->
                <template v-for="offset in [-2, -1, 0, 1, 2]" :key="offset">
                    <button v-if="currentPage + offset > 1 && currentPage + offset < totalPages" @click="currentPage += offset" :class="['px-2 py-1 text-sm rounded-md', { 'bg-gray-800 border-2 border-gray-300 text-white font-bold': currentPage + offset === currentPage, 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-300 dark:bg-gray-500': currentPage + offset !== currentPage }]">{{ currentPage + offset }}</button>
                </template>
                <!-- Mostrar "..." si hay números siguientes -->
                <span v-if="currentPage<totalPages-3" class="px-2 py-1 text-sm rounded-md text-gray-500 dark:text-gray-200 dark:bg-gray-700">...</span>
                <!-- Mostrar el último número -->
                <button @click="currentPage = totalPages" :class="['px-2 py-1 text-sm rounded-md', { 'bg-gray-800 border-2 border-gray-300 text-white font-bold': currentPage === totalPages, 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-300 dark:bg-gray-500': currentPage !== totalPages }]">{{ totalPages }}</button>
            </template>
        </div>
        <button @click="goToNextPage" class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
            <span>Siguiente</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </button>
    </div>
    <!-- Aquí mostramos el número total de páginas y la página actual -->
    <div class="flex items-center justify-center mt-4 text-gray-800 dark:text-gray-300">
        <span class="text-sm">Página {{ currentPage }} de {{ totalPages }} - {{ len_table }} Datos</span>
    </div>
</section>
</template>
<style>
/* Personaliza el contenedor con scroll horizontal */
.scroll-container {
  /* Establece una altura máxima para el contenedor */
  max-height: 100%; /* Puedes ajustar esto según tus necesidades */

  /* Establece un ancho máximo para el contenedor */
  max-width: 100%; /* O el ancho que desees */

  /* Hace que el scroll sea visible y personalizado */
  overflow-x: scroll;
}

/* Personaliza la scrollbar */
.scroll-container::-webkit-scrollbar {
  width: 5px; /* Establece el ancho de la scrollbar para navegadores Webkit (Safari, Chrome) */
}

.scroll-container::-webkit-scrollbar-thumb {
  background-color: rgb(75, 85, 99); /* Color del pulgar de la scrollbar */
  border-radius: 10px; /* Radio de borde del pulgar */
}

.scroll-container::-webkit-scrollbar-thumb:hover {
  background-color: rgb(17, 24, 39); /* Cambia el color al pasar el mouse */
}
</style>