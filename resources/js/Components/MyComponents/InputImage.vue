<script setup>
import { ref } from 'vue';
const emit = defineEmits(['update:modelValue']);
const showDiv = ref(false);
const photoInput = ref(null);
const photoPreview = ref(null);
const selectNewPhoto = () => {
    photoInput.value.click();
};
const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];
    emit('update:modelValue', photo); // Emitimos el evento con el archivo seleccionado
    if (! photo) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(photo);
};
</script>
<template>
    <div class="flex items-center justify-center w-full">
        <label 
            :style="photoPreview ? 'background-image: url(\'' + photoPreview + '\');' : ''"
            :class="photoPreview? 'bg-contain aspect-[16/9] bg-no-repeat bg-center':'bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600'"
            class="flex flex-col w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:border-gray-600 dark:hover:border-gray-500"
            @mouseenter="showDiv = true"
            @mouseleave="showDiv = false">
            <div v-if="!photoPreview || showDiv" id="iconoImg" class="flex flex-col h-full items-center justify-center pt-5 pb-6  hover:opacity-70 hover:bg-slate-900" @click.prevent="selectNewPhoto">
                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-100"><span class="font-semibold">Click para cargar</span> o cambiar el archivo</p>
                <p class="text-xs text-gray-500 dark:text-gray-100">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                <button v-if="photoPreview" class="px-4 mt-6 bg-gray-400 border-2 border-gray-300 rounded-lg dark:hover:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:border-gray-500">ver</button>
            </div>
            <input @change="updatePhotoPreview" ref="photoInput" type="file" class="hidden" />
        </label>
    </div> 
</template>