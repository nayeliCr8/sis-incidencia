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
defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

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
        <aside :class="{'w-100':showingNavigationDropdown,'ml-[-100%]':!showingNavigationDropdown}" class=" fixed z-10 top-0 pb-3 px-6 flex flex-col justify-between h-screen border-r bg-white transition duration-300 lg:ml-0 md:w-4/12 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
            <div>
                <div class="mt-4 text-center my-2">
                    <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
                    <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block">{{ $page.props.auth.user.name }}</h5>
                    <span class="hidden text-gray-400 lg:block">Admin</span>
                </div>
             <ul class="space-y-2 tracking-wide mt-8">
                 <li>
                     <SederbarLink :href="route('admin.prueba')" :active="route().current('admin.prueba')" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl">
                         <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                             <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                             <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                             <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current group-hover:text-sky-300"></path>
                         </svg>
                         <span class="-mr-1 font-medium">Dashboard</span>
                     </SederbarLink>
                 </li>
                 <li>
                     <SederbarLink :href="route('admin.etiqueta.index')" :active="route().current('admin.etiqueta.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                             <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                             <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                         </svg>
                         <span class="group-hover:text-gray-700">Categories</span>
                     </SederbarLink>
                 </li>
                 <li>
                    <SederbarLink :href="route('admin.incidencia.index')" :active="route().current('admin.incidencia.index')" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                        <!-- Nuevo ícono SVG para Incidencias -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 640 512">
                        <path class="fill-current text-gray-400 group-hover:text-cyan-300" d="M384 96V320H64L64 96H384zM64 32C28.7 32 0 60.7 0 96V320c0 35.3 28.7 64 64 64H181.3l-10.7 32H96c-17.7 0-32 14.3-32 32s14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H277.3l-10.7-32H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/> 
                        <path class="fill-current text-gray-600 group-hover:text-cyan-800" d="M 534 0 c -26.5 0 -48 21.5 -48 48 V 432 c 0 26.5 21.5 48 48 48 h 64 c 26.5 0 48 -21.5 48 -48 V 48 C 646 21 624.5 0 598 0 H 598 z m 16 64 h 32 c 8.8 0 16 7.2 16 16 s -7.2 16 -16 16 H 550 c -8.8 0 -16 -7.2 -16 -16 s 7.2 -16 16 -16 z m -16 80 c 0 -8.8 7.2 -16 16 -16 h 32 c 8.8 0 16 7.2 16 16 s -7.2 16 -16 16 H 550 c -8.8 0 -16 -7.2 -16 -16 z m 32 160 a 32 32 0 1 1 0 64 a 32 32 0 1 1 0 -64 z"/>
                        </svg>
                        <span class="group-hover:text-gray-700">Incidencias</span>
                    </SederbarLink>
                </li>
                 <li>
                     <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                             <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                             <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                         </svg>
                         <span class="group-hover:text-gray-700">Reports</span>
                     </a>
                 </li>
                 <li>
                     <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                             <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                             <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                         </svg>
                         <span class="group-hover:text-gray-700">Other data</span>
                     </a>
                 </li>
                 <li>
                     <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                             <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                             <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                         </svg>
                         <span class="group-hover:text-gray-700">Finance</span>
                     </a>
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

<style lang="scss" scoped>

</style>