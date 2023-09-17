<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
defineProps({
  oficinas: Object,
  estados: Object,
});

const form = useForm({
  marca: "",
  serie: "",
  ip: "",
  estado: "",
  observacion: "",
  tipo: "",
  oficina: "",
});

const save = () => {
  form.post(route("admin.equipos.store"));
};
</script>

<template>
  <AdminLayout>
    <Head title="Equipos" />
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
      <div
        class="w-full border-collapse bg-white text-left text-sm text-gray-500 dark:bg-gray-800 rounded-lg shadow-xl sm:w-full sm:mx-auto"
      >
        <div class="p-4">
          <div class="mb-6">
            <InputLabel>Marca</InputLabel>
            <TextInput class="w-full" v-model="form.marca"></TextInput>
            <InputError class="mt-2" :message="form.errors.marca" />
          </div>
          <div class="mb-6">
            <InputLabel>Serie</InputLabel>
            <TextInput class="w-full" v-model="form.serie"></TextInput>
            <InputError class="mt-2" :message="form.errors.serie" />
          </div>
          <div class="mb-6">
            <InputLabel>Protocolo de Internet (IP)</InputLabel>
            <TextInput class="w-full" v-model="form.ip" maxlenght="8"></TextInput>
            <InputError class="mt-2" :message="form.errors.ip" />
          </div>
          <div class="mb-6">
            <InputLabel>Estado</InputLabel>
            <select v-model="form.estado" id="estado" name="estado" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
              <option v-for="estado in estados" :key="estado.id">
                {{ estado }}
              </option>
            </select>
            <InputError class="mt-2" :message="form.errors.estado" />
          </div>
          <div class="mb-6">
            <InputLabel>Observación</InputLabel>
            <textarea
              class="w-full rounded dark:bg-gray-800 text-white"
              rows="5"
              v-model="form.observacion"
            />
            <InputError class="mt-2" :message="form.errors.observacion" />
          </div>
          <div class="mb-6">
            <InputLabel>Tipo de equipo</InputLabel>
            <TextInput class="w-full" v-model="form.tipo"></TextInput>
            <InputError class="mt-2" :message="form.errors.tipo" />
          </div>
          <div class="mb-6">
            <InputLabel>Oficina</InputLabel>
            <select v-model="form.oficina" id="oficina" name="oficina" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
              <option v-for="oficina in oficinas" :key="oficina.id" :value="oficina.id">
                {{ oficina.nombre }}
              </option>
            </select>
            <InputError class="mt-2" :message="form.errors.oficina" />
          </div>
          <div class="mt-6 flex space-x-4 justify-end">
            <Link
              :href="route('admin.equipos.index')"
              class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
              >Cancelar</Link
            >
            <PrimaryButton @click="save()">Registrar</PrimaryButton>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
