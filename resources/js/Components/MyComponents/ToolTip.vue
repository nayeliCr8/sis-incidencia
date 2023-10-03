<script setup>
defineProps({
    img:{Object,},
});
  import { ref } from 'vue';
  
  const tooltipVisible = ref(false);
  
  const handleMouseOver = () => {
    tooltipVisible.value = true;
  };
  
  const handleMouseOut = () => {
    tooltipVisible.value = false;
  };

</script>
<template>
    
    <div>
        <button
            data-tooltip-target="tooltip-no-arrow"
            @mouseover="handleMouseOver"
            @mouseout="handleMouseOut"> 
            <slot name="main"/>
      <!-- <img class="w-10 h-10 rounded" :src="img"> -->
        </button>
        <div
            id="tooltip-no-arrow"
            role="tooltip"
            class="fixed left-0 m-4 z-50 px-3 py-2 text-white bg-gray-900 rounded-lg shadow-lg tooltip dark:bg-gray-700"
            v-if="tooltipVisible"
            @mouseover="handleMouseOver"
            @mouseout="handleMouseOut">
            <slot name="tooltip"/>
        </div>
    </div>
</template>