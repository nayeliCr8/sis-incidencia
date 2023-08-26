<script setup>
defineProps({
    tipo: String,
});
</script>

<template>

<div class='flex items-center m-2 rounded-lg justify-center max-w-md max-h-sm from-pink-200 via-purple-300 to-blue-500 bg-gradient-to-br'>
    <div class='w-full max-w-lg py-8 flex flex-row items-center justify-center mx-auto bg-[#FFFBFB] rounded-lg shadow-xl'>
        <div class="flex flex-col md:flex-row w-3/4 md:w-5/6 space-x-0 md:space-x-8">
            <div class="w-full md:w-2/5 flex flex-col items-center justify-center text-4xl">
                <i v-if="tipo === '0'" class="fa-solid fa-computer text-8xl"></i>
                <svg v-else-if="tipo === '1'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
            </div>
            <div class="w-full md:w-3/5 space-y-4 flex flex-col justify-center items-center">
                <div class="flex flex-col justify-center">
                    <h1 class="text-center md:text-left text-2xl font-bold text-gray-900">Justine Howell</h1>
                    <p class="inline text-gray-700 font-normal leading-6 w-full text-base">UX Researcher, Co-host of the Interesting Design podcast
                        and a proud mother of three children</p>
                </div>
                <ul class="space-y-4  md:space-y-0 space-x-0 md:space-x-4 flex flex-col md:flex-row text-left justify-center">
                    <li class="text-sm"><i class="iconoir-pin-alt mr-2"></i>NYC</li>
                    <li class="text-sm"><i class="iconoir-calendar mr-2"></i>Member since 2019 </li>
                </ul>

                <ul class="space-x-4 flex flex-row justify-center w-full mb-4">
                    <li class="text-sm text-gray-800"><strong class="text-gray-900">10.9k</strong> Followers</li>
                    <li class="text-sm text-gray-800"><strong class="text-gray-900">100</strong> Following</li>
                </ul>
                <button class="transition-colors bg-purple-700 hover:bg-purple-800 p-2 rounded-sm w-full text-white text-hover shadow-md shadow-purple-900">
                    Follow
                </button>
            </div>
        </div>
    </div>
</div>
</template>
