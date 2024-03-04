<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'bg-[#E2E8F0] text-[#1E293B]rounded-md px-3 py-2 text-sm font-medium' 
        : 'text-[#1E293B] rounded-md px-3 py-2 text-sm font-medium';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
