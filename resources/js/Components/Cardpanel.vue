<script setup>
defineProps({
    color: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <div class=" h-fit bg-white shadow-sm dark:bg-[#191D22] dark:text-gray-200 rounded-md">
        <slot />
    </div>
</template>