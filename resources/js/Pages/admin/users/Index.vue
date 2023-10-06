<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { usePermission } from "@/composables/permissions";

defineProps(["users"]);
const form = useForm({})
const { hasPermission } = usePermission();
const showConfirmDeleteUserModal = ref(false)

const confirmDeleteUser = () => {
      showConfirmDeleteUserModal.value = true;
}

const closeModal = () => {
  showConfirmDeleteUserModal.value = false;
}

const deleteUser = (id) => {
   form.delete(route('admin.users.destroy', id), {
    onSuccess: () => closeModal()
   });
}
</script>

<template>
  <Head title="Users index" />

  <AdminLayout>
    <div class="w-full p-4">
      <div class="flex justify-end mr-6">
        <Link
          :href="route('admin.users.create')"
          class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
          >Registrar usuario</Link
        >
      </div>
      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Rol</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
          <TableRow v-for="user in users" :key="user.id" class="border-b">
              <TableDataCell class="space-x-4">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                  <div class="relative h-10 w-10">
                    <img class="h-full w-full rounded-full object-cover object-center"
                      :src="user.profile_photo_url"
                      alt=""
                    />
                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                  </div>
                  <div class="text-sm">
                    <div class="font-medium text-gray-700">{{ user.name }}</div>
                    <div class="text-gray-400">{{ user.email }}</div>
                  </div>
                </th>
              </TableDataCell>
              <TableDataCell class="space-x-4" >{{ user.name }}</TableDataCell>
              <TableDataCell class="space-x-4" >{{ user.roles[0]?user.roles[0].name:'sin Rol' }}</TableDataCell>
              <TableDataCell class="space-x-4" >
                <div class="flex space-x-2">
                  <template v-if="hasPermission('user update')">
                      <Link :href="route('admin.users.edit', user.id)"
                        class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        >Editar</Link>
                  </template>
                  <template v-if="hasPermission('user update')">
                    <button v-if="user.roles[0]==null || user.roles[0].name != 'superadmin'" @click="confirmDeleteUser" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Eliminar</button>
                  </template>
                </div>
                  
              </TableDataCell>
          </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>
