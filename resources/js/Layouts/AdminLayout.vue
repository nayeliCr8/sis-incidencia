<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SederbarLink from '@/Components/SederbarLink.vue';
import { usePermission } from "@/composables/permissions";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const { hasPermission } = usePermission();

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="w-full h-full">
        <aside :class="{'w-100':showingNavigationDropdown,'ml-[-100%]':!showingNavigationDropdown}" 
        class="fixed z-10 pb-3 pl-6 flex flex-col justify-between h-screen border-r bg-white transition duration-300 lg:ml-0 md:w-4/12 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
            <div class="mt-4 text-center my-2">
                <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
                <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block">{{ $page.props.auth.user.name }}</h5>
                <span class="hidden text-gray-400 lg:block">Admin</span>
            </div>
            <div class="overflow-auto p-2">
             <ul class="space-y-2 tracking-wide mt-2">
                 <li>
                     <div>
                        <SederbarLink :href="route('admin.prueba')" :active="route().current('admin.prueba')" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl">
                         <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                             <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                             <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                             <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current group-hover:text-sky-300"></path>
                         </svg>
                         <span class="-mr-1 font-medium">Dashboard</span>
                     </SederbarLink>
                     </div>
                 </li>
                 <!-- <li>
                     <div>
                        <SederbarLink :href="route('admin.etiqueta.index')" :active="route().current('admin.etiqueta.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                            </svg>
                            <span class="group-hover:text-gray-700">Categories</span>
                        </SederbarLink>
                     </div>
                 </li> -->
                 <li>
                    <div>
                        <SederbarLink v-if="hasPermission('incidencia index')" :href="route('admin.incidencias.index')" :active="route().current('admin.incidencias.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <!-- Nuevo ícono SVG para Incidencias -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 640 512">
                            <path class="fill-current text-gray-400 group-hover:text-cyan-300" d="M384 96V320H64L64 96H384zM64 32C28.7 32 0 60.7 0 96V320c0 35.3 28.7 64 64 64H181.3l-10.7 32H96c-17.7 0-32 14.3-32 32s14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H277.3l-10.7-32H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/> 
                            <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M 534 0 c -26.5 0 -48 21.5 -48 48 V 432 c 0 26.5 21.5 48 48 48 h 64 c 26.5 0 48 -21.5 48 -48 V 48 C 646 21 624.5 0 598 0 H 598 z m 16 64 h 32 c 8.8 0 16 7.2 16 16 s -7.2 16 -16 16 H 550 c -8.8 0 -16 -7.2 -16 -16 s 7.2 -16 16 -16 z m -16 80 c 0 -8.8 7.2 -16 16 -16 h 32 c 8.8 0 16 7.2 16 16 s -7.2 16 -16 16 H 550 c -8.8 0 -16 -7.2 -16 -16 z m 32 160 a 32 32 0 1 1 0 64 a 32 32 0 1 1 0 -64 z"/>
                            </svg>
                            <span class="group-hover:text-gray-700">Incidencias</span>
                        </SederbarLink>
                    </div>
                </li>
                 <li>
                    <div>
                        <SederbarLink v-if="hasPermission('user index')" :href="route('admin.users.index')" :active="route().current('admin.users.*')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                    />
                                </svg>
                            <span class="group-hover:text-gray-700">Usuarios</span>
                        </SederbarLink>
                    </div>
                </li>
                 <li>
                    <div>
                        <SederbarLink v-if="hasPermission('rol index')" :href="route('admin.roles.index')" :active="route().current('admin.roles.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"
                            />
                        </svg>
                            <span class="group-hover:text-gray-700">Roles</span>
                        </SederbarLink>
                    </div>
                </li>
                <li>
                    <div>
                        <SederbarLink v-if="hasPermission('permiso index')" :href="route('admin.permissions.index')" :active="route().current('admin.permissions.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33"
                                    />
                                </svg>
                            <span class="group-hover:text-gray-700">Permisos</span>
                        </SederbarLink>
                    </div>
                </li>
                <li>
                    <div>
                        <SederbarLink v-if="hasPermission('sede index')" :href="route('admin.sedes.index')" :active="route().current('admin.sedes.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                            </svg>
                            <span class="group-hover:text-gray-700">Sedes</span>
                        </SederbarLink>
                    </div>
                </li>
                <li>
                   <div>
                    <SederbarLink v-if="hasPermission('oficina index')" :href="route('admin.oficinas.index')" :active="route().current('admin.oficinas.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                            <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                        </svg>
                        <span class="group-hover:text-gray-700">Oficinas</span>
                    </SederbarLink>
                   </div>
                </li>
                <li>
                   <div>
                    <SederbarLink v-if="hasPermission('equipo index')" :href="route('admin.equipos.index')" :active="route().current('admin.equipos.*')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                            <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                        </svg>
                        <span class="group-hover:text-gray-700">Equipos</span>
                    </SederbarLink>
                   </div>
                </li>
            </ul>
            </div>
     
         <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
             <form @submit.prevent="logout">
             <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                 </svg>
                    <span class="group-hover:text-gray-700">Cerrar sesión</span>
                </button>
            </form>
         </div>
     </aside>

     <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
      <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
          <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
              <h5 hidden class="text-2xl text-gray-600 font-medium lg:block">Dashboard</h5>
              <button class="w-12 h-16 -mr-2 border-r lg:hidden" @click="showingNavigationDropdown=!showingNavigationDropdown">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
              </button>
              
              <div class="flex space-x-4">
                
                <button aria-label="notification" class="w-10 h-10 mr-2 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <Link :href="route('dashboard')"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" viewBox="0 0 640 512">
                        <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H544c53 0 96-43 96-96V96c0-53-43-96-96-96H96zM64 96c0-17.7 14.3-32 32-32H544c17.7 0 32 14.3 32 32V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7h56.1c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4H149.3C119.9 256 96 279.9 96 309.3zM461.2 336h56.1c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3H421.3c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1H280c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24H408c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/>
                    </svg>
                </Link>
                </button>
                  <!--search bar -->
                  <div hidden class="md:block">
                      <div class="relative flex items-center text-gray-400 focus-within:text-cyan-400">
                          <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                          <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
                              <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                          </svg>
                          </span>
                          <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here" class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300 focus:border-cyan-300 transition">
                      </div>
                  </div>
                  <!--/search bar -->
                  <button aria-label="search" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden">
                      <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 mx-auto fill-current text-gray-600" viewBox="0 0 35.997 36.004">
                          <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                      </svg>
                  </button>
                  <button aria-label="chat" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                      </svg>
                  </button>
                  <button aria-label="notification" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                      </svg>
                  </button>
              </div>
          </div>
      </div>
  
        <div class="px-6 pt-6 2xl:container">
            <slot>
                
            </slot>
        </div>
        </div>
    </div>
</template>

<style>

body::-webkit-scrollbar{
    width: 10px;
}

body::-webkit-scrollbar-thumb{
    background: #16222A;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to top, #3A6073, #16222A);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to top, #3A6073, #16222A); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    border-radius: 8px;
}

div.overflow-auto::-webkit-scrollbar{
    width: 5px;
}

div.overflow-auto::-webkit-scrollbar-thumb{
    background: linear-gradient(180deg, rgba(9,151,170,1) 0%, rgba(103,232,249,1) 49%);
    border-radius: 8px;
}
</style>