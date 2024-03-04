<script setup>
defineProps({
    color: {
        type: String,
        default: '',
    },
    shadow: {
        type: String,
        default: 'shadow'
    }
});
</script>

<template>
    <div class="p-4 h-fit bg-white shadow-md rounded-2xl dark:bg-[#191D22] dark:text-gray-200" :class="shadow">
        <slot />
    </div>
</template>