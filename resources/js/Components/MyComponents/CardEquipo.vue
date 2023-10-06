<script setup>
const props = defineProps({
    tipo: {
        type: String,
        requeried: true,
    },
    datosKeysHeaders: {
        type: Object,
    },
    datos: {
        type: Object,
    },
    titulo: {
        type: String,
        default: 'Equipo',
    },
});

const emit = defineEmits(['editar']);
const clickbuttomn= ()=>{
    emit('editar',props.datos.id);
}
</script>

<template>
    <!-- <div>{{ datos }}</div> -->
    <!-- <div class='flex items-center m-2 rounded-lg justify-center max-w-md max-h-sm from-pink-200 via-purple-300 to-blue-500 bg-gradient-to-br'> -->
<div class='flex items-center m-2 rounded-lg justify-center max-w-md max-h-sm bg-white dark:bg-gray-800'>
    <div class='w-full max-w-lg py-8 flex flex-row items-center justify-center mx-auto bg-white rounded-lg border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700'>
        <div class="flex flex-col md:flex-row w-3/4 md:w-5/6 space-x-0 md:space-x-8">
            <div class="w-full md:w-2/5 flex flex-col items-center justify-center text-4xl">
                <!-- <i v-if="tipo === 'PC'" class="fa-solid fa-computer text-8xl"></i> -->
                <svg v-if="tipo === 'PC'" class="w-24 dark:bg-white rounded-lg p-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path d="M384 96V320H64L64 96H384zM64 32C28.7 32 0 60.7 0 96V320c0 35.3 28.7 64 64 64H181.3l-10.7 32H96c-17.7 0-32 14.3-32 32s14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H277.3l-10.7-32H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm464 0c-26.5 0-48 21.5-48 48V432c0 26.5 21.5 48 48 48h64c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H528zm16 64h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H544c-8.8 0-16-7.2-16-16s7.2-16 16-16zm-16 80c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H544c-8.8 0-16-7.2-16-16zm32 160a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                </svg>
                <svg v-else-if="tipo === 'Impresora'" class="w-24 dark:bg-white rounded-lg p-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                <svg v-else-if="tipo === 'Scanner'" class="w-24 dark:bg-white rounded-lg p-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                    <g transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                        <path d="M 79.074 80.396 H 10.926 C 4.901 80.396 0 75.495 0 69.471 v -13.43 c 0 -1.104 0.896 -2 2 -2 h 86 c 1.104 0 2 0.896 2 2 v 13.43 C 90 75.495 85.099 80.396 79.074 80.396 z M 4 58.041 v 11.43 c 0 3.819 3.107 6.926 6.926 6.926 h 68.148 c 3.819 0 6.926 -3.106 6.926 -6.926 v -11.43 H 4 z" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <path d="M 2.001 58.041 c -0.622 0 -1.235 -0.289 -1.625 -0.833 c -0.645 -0.896 -0.44 -2.146 0.457 -2.791 L 62.664 9.979 c 0.896 -0.646 2.146 -0.44 2.791 0.457 c 0.645 0.897 0.44 2.146 -0.457 2.791 L 3.167 57.665 C 2.814 57.919 2.406 58.041 2.001 58.041 z" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <path d="M 81.894 49.239 H 29.417 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 52.477 c 1.104 0 2 0.896 2 2 S 82.998 49.239 81.894 49.239 z" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <path d="M 2 56.041 v 13.43 c 0 4.93 3.996 8.926 8.926 8.926 h 68.148 c 4.93 0 8.926 -3.996 8.926 -8.926 v -13.43 H 2 z M 71.845 64.932 h -1.671 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 1.671 c 1.104 0 2 0.896 2 2 S 72.949 64.932 71.845 64.932 z M 80.394 64.932 h -1.671 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 1.671 c 1.104 0 2 0.896 2 2 S 81.498 64.932 80.394 64.932 z" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                </svg>
                <!-- <svg v-else-if="tipo === 'Telefono'" class="w-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M347.1 24.6c7.7-18.6 28-28.5 47.4-23.2l88 24C499.9 30.2 512 46 512 64c0 247.4-200.6 448-448 448c-18 0-33.8-12.1-38.6-29.5l-24-88c-5.3-19.4 4.6-39.7 23.2-47.4l96-40c16.3-6.8 35.2-2.1 46.3 11.6L207.3 368c70.4-33.3 127.4-90.3 160.7-160.7L318.7 167c-13.7-11.2-18.4-30-11.6-46.3l40-96z"/></svg> -->
                <svg v-else-if="tipo === 'Telefono'" class="w-24 dark:bg-white rounded-lg p-2" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                    <g transform="translate(0,256) scale(0.1,-0.1)" stroke="none">
                        <path d="M415 2278 c-46 -17 -110 -64 -143 -105 -69 -89 -106 -200 -139 -418 -26 -174 -26 -776 0 -950 36 -241 78 -354 164 -442 57 -58 110 -85 179 -91 5 -4 51 -4 58 28 11 59 6 220 -9 289 -9 38 -33 101 -53 141 -33 63 -42 74 -77 86 -86 29 -128 125 -147 337 -9 96 -9 158 0 255 19 211 61 307 147 337 33 11 45 23 72 72 61 111 89 297 67 436 -6 36 -8 37 -48 36 -22 0 -54 -5 -71 -11z"/>
                        <path d="M573 2227 c21 -117 -14 -323 -74 -425 -10 -18 -19 -35 -19 -38 0 -2 20 -4 45 -4 55 0 81 23 121 109 50 105 42 323 -13 374 -10 8 -30 20 -44 25 l-26 10 10 -51z"/>
                        <path d="M864 2226 c-56 -25 -74 -59 -74 -143 0 -106 -24 -201 -69 -270 -45 -69 -101 -109 -179 -127 l-57 -13 -27 -69 c-38 -101 -58 -210 -58 -324 0 -115 20 -224 58 -324 l27 -69 65 -21 c105 -34 178 -104 215 -206 10 -25 19 -92 22 -153 5 -96 9 -112 30 -138 14 -16 41 -33 61 -39 25 -8 233 -10 652 -8 l615 3 66 31 c78 37 136 87 177 152 62 97 62 94 62 772 0 678 0 675 -62 772 -41 65 -99 115 -177 152 l-66 31 -625 2 c-510 2 -631 0 -656 -11z m1283 -259 c27 -27 28 -30 31 -165 3 -108 0 -146 -12 -175 -28 -67 -26 -67 -564 -67 -316 0 -490 4 -510 11 -55 19 -62 41 -62 209 0 84 5 160 10 170 26 49 30 50 572 47 l508 -2 27 -28z m-862 -597 c12 -38 -11 -51 -89 -48 -59 3 -71 6 -74 21 -8 40 4 47 82 47 66 0 75 -2 81 -20z m260 -15 l0 -30 -74 0 c-58 0 -76 4 -84 17 -8 12 -7 21 3 33 10 12 28 15 84 13 l71 -3 0 -30z m270 24 c4 -5 4 -21 1 -35 -6 -24 -9 -25 -84 -22 -65 3 -77 6 -80 21 -8 40 4 47 82 47 42 0 78 -5 81 -11z m264 -3 c9 -11 10 -20 1 -35 -9 -18 -20 -21 -80 -21 -55 0 -71 4 -79 17 -6 11 -6 24 0 35 8 15 23 18 78 18 47 0 72 -4 80 -14z m-819 -166 c43 -43 33 -107 -20 -135 -81 -42 -156 56 -99 129 26 33 88 37 119 6z m267 -2 c66 -62 -14 -176 -95 -134 -40 21 -58 66 -42 106 7 17 20 35 29 40 29 17 83 11 108 -12z m268 -3 c32 -31 32 -75 1 -111 -33 -39 -89 -39 -122 0 -49 56 -13 136 61 136 25 0 44 -8 60 -25z m262 3 c30 -34 34 -55 19 -92 -17 -42 -62 -60 -106 -44 -36 12 -50 35 -50 79 0 71 90 108 137 57z m-806 -241 c62 -48 40 -137 -37 -153 -44 -9 -94 35 -94 82 0 65 81 109 131 71z m273 -8 c20 -16 26 -29 26 -57 -1 -109 -144 -123 -166 -16 -4 24 0 37 21 62 32 39 79 43 119 11z m271 -4 c48 -47 18 -128 -52 -141 -27 -5 -37 -1 -63 24 -57 58 -25 142 55 142 25 0 44 -8 60 -25z m262 3 c30 -34 34 -55 19 -92 -18 -44 -64 -63 -106 -46 -37 15 -50 37 -50 81 0 71 90 108 137 57z m-792 -260 c32 -38 29 -81 -11 -115 -29 -27 -54 -29 -93 -8 -75 38 -43 155 43 155 26 0 40 -7 61 -32z m260 7 c41 -40 33 -105 -16 -130 -39 -21 -64 -19 -93 8 -40 34 -43 77 -11 115 34 41 84 44 120 7z m250 19 c19 -8 45 -55 45 -84 0 -31 -53 -80 -85 -80 -38 0 -85 50 -85 90 0 58 65 97 125 74z m273 -10 c35 -24 44 -59 27 -100 -35 -85 -155 -59 -155 35 0 67 73 104 128 65z"/>
                        <path d="M480 796 c0 -2 15 -37 34 -77 50 -108 70 -220 62 -342 l-6 -99 32 19 c57 32 73 80 73 218 0 110 -3 125 -28 176 -42 86 -67 109 -122 109 -25 0 -45 -2 -45 -4z"/>
                    </g>
                </svg>
            </div>
            <div class="w-full md:w-3/5 space-y-4 flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center">
                    <h1 class="text-center md:text-left text-2xl font-bold text-gray-900 dark:text-white uppercase">{{titulo}}</h1>
                    <!-- <p class="inline text-gray-700 font-normal leading-6 w-full text-base">UX Researcher, Co-host of the Interesting Design podcast
                        and a proud mother of three children</p> -->
                </div>
                <ul v-for="dat,_key in datosKeysHeaders" :key="_key" class="space-x-4 flex flex-row w-full mb-4">
                    <li class="text-sm text-gray-800 dark:text-white"><strong class="text-gray-900 dark:text-white uppercase">{{dat}} :</strong> {{datos[_key]}} </li>
                </ul>
                
                <button @click="clickbuttomn" class="transition-colors bg-purple-700 hover:bg-purple-800 p-2 rounded-md w-full text-white text-hover shadow-md shadow-purple-900">
                    <slot/> 
                </button>
            </div>
        </div>
    </div>
</div>
</template>
