<template>
    <div class="relative">
      <div @click="toggleListbox" class="relative">
        <button
          ref="button"
          @click="toggleListbox"
          :aria-expanded="isOpen"
          aria-haspopup="listbox"
          class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
        >
          <span class="block truncate">{{ selectedOption || placeholder }}</span>
          <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
              <path
                d="M7 7l3-3 3 3m0 6l-3 3-3-3"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></path>
            </svg>
          </span>
        </button>
      </div>
      <div v-if="isOpen" class="absolute mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
        <input
          v-model="search"
          @input="filterOptions"
          @keydown.enter="selectOption(filteredOptions[focusedOptionIndex])"
          @keydown.arrow-up.prevent="focusPreviousOption"
          @keydown.arrow-down.prevent="focusNextOption"
          type="search"
          class="w-full px-3 py-2 bg-white border-b border-gray-300 focus:outline-none"
        />
        <ul
          ref="listbox"
          role="listbox"
          :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
          tabindex="-1"
          class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
        >
          <li
            v-for="(option, index) in filteredOptions"
            :key="option.value"
            @click="selectOption(option)"
            @mouseenter="focusedOptionIndex = index"
            @mouseleave="focusedOptionIndex = null"
            role="option"
            :aria-selected="focusedOptionIndex === index"
            :class="{
              'text-white bg-indigo-600': index === focusedOptionIndex,
              'text-gray-900': index !== focusedOptionIndex,
            }"
            class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9"
          >
            <span :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }" class="block font-normal truncate">
              {{ option.label }}
            </span>
            <span
              v-show="option.value === selectedValue"
              :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
              class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
            >
              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </span>
          </li>
          <li v-if="filteredOptions.length === 0" class="px-3 py-2 text-gray-900 cursor-default select-none">
            No options match your search.
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  
  const options = ref([
    { value: 'au', label: 'Australia' },
    { value: 'be', label: 'Belgium' },
    { value: 'cn', label: 'China' },
    // ... Agrega más opciones de países aquí ...
  ]);
  
  const isOpen = ref(false);
  const focusedOptionIndex = ref(null);
  const selectedValue = ref('');
  const search = ref('');
  const placeholder = 'Select a country';
  const name = 'country';
  
  const toggleListbox = () => {
    isOpen.value = !isOpen.value;
    focusedOptionIndex.value = options.value.findIndex((option) => option.value === selectedValue.value);
  };
  
  const focusNextOption = () => {
    if (focusedOptionIndex.value === null) focusedOptionIndex.value = 0;
    else if (focusedOptionIndex.value + 1 < filteredOptions.length) focusedOptionIndex.value++;
  };
  
  const focusPreviousOption = () => {
    if (focusedOptionIndex.value === null) focusedOptionIndex.value = filteredOptions.length - 1;
    else if (focusedOptionIndex.value > 0) focusedOptionIndex.value--;
  };
  
  const selectOption = (option) => {
    selectedValue.value = option.value;
    isOpen.value = false;
  };
  
  const selectedOption = computed(() => options.value.find((option) => option.value === selectedValue.value));
  
  const filteredOptions = computed(() => {
    return options.value.filter((option) => option.label.toLowerCase().includes(search.value.toLowerCase()));
  });
  
  const filterOptions = () => {
    focusedOptionIndex.value = null;
  };
  
  </script>
  