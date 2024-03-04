<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
// import ApplicationMark from './ApplicationMark.vue';
import ApplicationLogo from './ApplicationLogo.vue';
// import Card from './Card.vue';

// DARK MODE
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
} else {
    document.documentElement.classList.remove('dark')
}

const toggleDarkMode = ref(localStorage.getItem('theme') == 'dark' ? true : false);

const changeDarkMode = () => {
    toggleDarkMode.value = document.documentElement.classList.toggle('dark');
    toggleDarkMode.value ?
        (localStorage.theme = 'dark') :
        (localStorage.theme = 'light');
};
</script>


<template>
    <!-- <div class="min-h-screen max-h-full bg-slate-100 dark:bg-[#323A45]">

        <nav class="bg-white border-b-2 border-gray-100 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between h-14 px-2 sm:px-6 md:px-6 lg:px-8">
                <div>
                                    <ApplicationLogo class="w-100"></ApplicationLogo>

                </div>
                <div class="flex items-center justify-center">
                    <div class="px-2 py-2 dark:text-gray-400 dark:hover:text-gray-300">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            @click="changeDarkMode()">
                            <i :class="{ 'hidden': toggleDarkMode, 'inline-flex': !toggleDarkMode }"
                                class="fa-solid fa-sun"></i>
                            <i :class="{ 'hidden': !toggleDarkMode, 'inline-flex': toggleDarkMode }"
                                class="fa-solid fa-moon"></i>
                        </button>
                    </div>
                    <div>
                        Página Principal
                    </div>
                </div>
            </div>
        </nav>

        <div class="min-h-screen max-h-full align-center md:flex md:justify-between md:items-center">
            <div class="hidden mt-8 h-fit w-full md:w-1/2 md:mt-0 md:block">
                <ApplicationMark></ApplicationMark>
            </div>
            <div class="mt-8 h-fit flex items-center justify-center w-full md:w-1/2 md:mt-0">
                <Card class="w-11/12 md:w-4/5">
                    <slot />
                </Card>
            </div>
        </div>
        <div class="md:hidden">
            <p class="text-transparent">---</p>
        </div>
    </div>
    <footer class="border-t-2 border-gray-100  dark:bg-gray-800 dark:border-gray-700">
        <p class="py-4 text-center dark:text-white">© 2024 C3NTOS, todos los derechos reservados</p>
    </footer> -->



    <div class="bg-white dark:bg-gray-900">
        <div class="bg-white dark:bg-gray-900 relative">

                        <button
                            class="absolute top-0 right-0 m-4  items-center justify-center p-2 rounded-full text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            @click="changeDarkMode()">
                            <i :class="{ 'hidden': toggleDarkMode, 'inline-flex': !toggleDarkMode }"
                                class="fa-solid fa-sun"></i>
                            <i :class="{ 'hidden': !toggleDarkMode, 'inline-flex': toggleDarkMode }"
                                class="fa-solid fa-moon"></i>
                        </button>
         </div>
        
        <div class="flex justify-center h-screen">
            
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://cdn.pixabay.com/photo/2017/08/02/00/49/people-2569234_960_720.jpg)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>

                           <!-- <img src="../../../public/img/grafico.png" alt="" width="100"> -->


                        <h2 class="text-4xl font-bold text-white">SISTEMAS DE INCIDENCIAS</h2>
                        
                        <p class="max-w-xl mt-3 text-gray-300">GOBIERNO REGIONAL PUNO</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
               

                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">
                            <!-- <ApplicationLogo></ApplicationLogo> -->
                            SISTEMA INCIDENCIAS </h2>
                        
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Iniciar Sesion</p>
                    </div>

                    <div class="mt-8">
                        <slot />
                       

                        <p class="mt-6 text-sm text-center text-gray-400">Pide tu cuenta? <a href="#" class="text-blue-500 focus:outline-none focus:underline hover:underline">Whatsapp</a>.</p>
                    </div>

                  
                </div>
            </div>
        </div>
    </div>
</template>

