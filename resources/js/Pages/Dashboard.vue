<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Card from '@/Components/Card.vue';
import Cardpanel from '@/Components/Cardpanel.vue';
import Buttonone from '@/Components/Buttonone.vue';
import Buttontwo from '@/Components/Buttontwo.vue';

import CardEquipo from '@/Components/MyComponents/CardEquipo.vue';
defineProps({
    darkModeIcon: Boolean,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- <template #header>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dashboard
                </h2>
</template>-->


            <div class=" h-screen">
            <Container>
            <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-1 px-4">
                <Cardpanel class="mt-4">
                    <div class="flex items-center mx-14 py-8 ">
                    <div class="relative p-2 py-5 w-full ">
                        <div class="mb-2 w-full">
                                <h2 class="text-xl md:text-3xl font-roboto font-extrabold w-full">
                                    <!-- {{ empresa.ruc }} -->
                                    ¡Bienvenido de nuevo,  {{ $page.props.auth.user.name }}!
                                </h2>
                                <span class=" font-sans text-sm text-slate-700 dark:text-slate-200">Gestiona tus prestamos mas facil!!</span>
                        </div>
                    </div>
                    <div class="flex justify-end w-full px-4 gap-2">
                        <Buttonone class="gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" fit="" height="20" width="20" preserveAspectRatio="xMidYMid meet" focusable="false">
                                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"></path>
                                <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"></path>
                            </svg>
                             Mensaje</Buttonone>
                        <Buttontwo class="gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" fit="" height="20" width="20" preserveAspectRatio="xMidYMid meet" focusable="false">
                                <path fill-rule="evenodd" d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 01-.517.608 7.45 7.45 0 00-.478.198.798.798 0 01-.796-.064l-.453-.324a1.875 1.875 0 00-2.416.2l-.243.243a1.875 1.875 0 00-.2 2.416l.324.453a.798.798 0 01.064.796 7.448 7.448 0 00-.198.478.798.798 0 01-.608.517l-.55.092a1.875 1.875 0 00-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 01-.064.796l-.324.453a1.875 1.875 0 00.2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 01.796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 01.517-.608 7.52 7.52 0 00.478-.198.798.798 0 01.796.064l.453.324a1.875 1.875 0 002.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 01-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 001.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 01-.608-.517 7.507 7.507 0 00-.198-.478.798.798 0 01.064-.796l.324-.453a1.875 1.875 0 00-.2-2.416l-.243-.243a1.875 1.875 0 00-2.416-.2l-.453.324a.798.798 0 01-.796.064 7.462 7.462 0 00-.478-.198.798.798 0 01-.517-.608l-.091-.55a1.875 1.875 0 00-1.85-1.566h-.344zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd"></path>
                            </svg>
                            Configuracion</Buttontwo>
                    </div> 
                </div>
                </Cardpanel>
            </div>

            <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 px-12 ">
                <Card class="">
                    <div class="relative p-2">
                        <div class="p-1 absolute right-0 rounded-md">
                            <i class="fa-solid fa-boxes-stacked text-xl text-[#3C82F6]"></i>
                        </div>
                        <div class="flex flex-col text-center ">
                        <div class="mb-2">
                            <h2 class="text-7xl font-black text-[#3C82F6] dark:text-gray-200">
                                <!-- {{ empresa.total_cajas }} -->
                                12
                            </h2>
                        </div>
                        
                            <div class="mb-2">
                            <h2 class="text-[#3C82F6] font-bold dark:text-gray-200">
                                Cajas
                            </h2>
                        </div>
                        <div>
                            <p class="text-xs">
                                Cajas de la empresa
                            </p>
                        </div>
                        </div>
                       
                    </div>
                </Card>

                <Card>
                    <div class="relative p-2">
                        <div class="p-1  absolute right-0 rounded-md">
                            <i class="fa-solid fa-users text-xl text-[#EF4444]"></i>
                        </div>
                        <div class="flex flex-col text-center ">
                        <div class="mb-2">
                            <h2 class="text-7xl font-black text-[#EF4444] dark:text-gray-200">
                                <!-- {{ empresa.total_users }} -->
                                12
                            </h2>
                        </div>
                        
                            <div class="mb-2">
                            <h2 class="text-[#EF4444] font-bold dark:text-gray-200">
                                Usuarios
                            </h2>
                        </div>
                        <div>
                            <p class="text-xs">
                                Usuarios de la empresa
                            </p>
                        </div>
                       </div>
                    </div>
                </Card>

                <Card>
                    <div class="relative p-2">
                        <div class="p-1 absolute right-0 rounded-md">
                            <i class="fa-solid fa-people-group text-xl text-[#F59E0C]"></i>
                        </div>
                        <div class="flex flex-col text-center ">
                        <div class="mb-2">
                            <h2 class="text-7xl font-black text-[#F59E0C] dark:text-gray-200">
                                <!-- {{ empresa.total_personals }} -->
                                23
                            </h2>
                        </div>
                        
                            <div class="mb-2">
                            <h2 class="text-[#F59E0C] font-bold dark:text-gray-200">
                                Personal
                            </h2>
                        </div>
                        <div>
                            <p class="text-xs">
                                Perosnal de la empresa
                            </p>
                        </div>
                       </div>
                       
                    </div>
                </Card>

                <Card>
                    <div class="relative p-2">
                        <div class="p-1 absolute right-0 rounded-md">
                            <i class="fa-solid fa-people-arrows text-xl text-[#22C55D]"></i>
                        </div>
                        <div class="flex flex-col text-center ">
                        <div class="mb-2">
                            <h2 class="text-7xl font-black text-[#22C55D] dark:text-gray-200">
                                <!-- {{ empresa.total_clientes }} -->
                                42
                            </h2>
                        </div>
                        
                            <div class="mb-2">
                            <h2 class="text-[#22C55D] font-bold dark:text-gray-200">
                                Cientes
                            </h2>
                        </div>
                        <div>
                            <p class="text-xs">
                                Clientes de la empresa
                            </p>
                        </div>
                       </div>
                    </div>
                </Card>
            </div>
        </Container>
    </div>
    </AppLayout>
</template>
