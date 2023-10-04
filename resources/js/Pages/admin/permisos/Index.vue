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
import DataTable from "@/Components/MyComponents/DataTable2.vue";
import { usePermission } from "@/composables/permissions";

defineProps(["permissions"]);

const { hasPermission } = usePermission();

const tablekeysheaders= ref({
     'name':'Nombre del Permiso',
    }
);

const customButtons= ref([{
        label: "Editar",
        action: 'editar',
        permisos: hasPermission('permiso update'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    {
        label: "Eliminar",
        action: 'eliminar',
        permisos: hasPermission('permiso delete'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);

const tableFiltros= ref([]);


const form = useForm({})


const showConfirmDeletePermissionModal = ref(false)

const confirmDeletePermission = () => {
      showConfirmDeletePermissionModal.value = true;
}

const closeModal = () => {
  showConfirmDeletePermissionModal.value = false;
}

const deletePermission = (id) => {
   form.delete(route('admin.permissions.destroy', id), {
    onSuccess: () => closeModal()
   });
}

const editPermission = (id) => {
  form.get(route('admin.permissions.edit', id));
}
</script>

<template>
  <Head title="Permissions" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end" v-if="hasPermission('permiso create')">
        <Link
          :href="route('admin.permissions.create')"
          class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
          >Registar Nuevo Permiso</Link
        >
      </div>
      <div class="mt-6">
        <DataTable
        :numerarRow="true"
        :table-keys-headers="tablekeysheaders" 
        :tableData="permissions"
        :customButtons="customButtons"
        :tableFiltros="tableFiltros"
        @editar="editPermission"
        @eliminar="deletePermission"
        />

        <!-- <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <template  v-if="hasPermission('permiso update','permiso delete')">
                <TableHeaderCell>Action</TableHeaderCell>
              </template>
            </TableRow>
          </template>
          <template #default>
            <TableRow
              v-for="permission in permissions"
              :key="permission.id"
              class="border-b"
            >
              <TableDataCell>{{ permission.id }}</TableDataCell>
              <TableDataCell>{{ permission.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <template v-if="hasPermission('permiso update')">
                  <Link
                    :href="route('admin.permissions.edit', permission.id)"
                    class="text-green-400 hover:text-green-600"
                    >Edit</Link
                  >
                </template>
              <template v-if="hasPermission('permiso delete')">
                <button @click="confirmDeletePermission" class="text-red-400 hover:text-red-600">Delete</button>
              </template>
               <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                 <div class="p-6">
                  <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this Permission?</h2>
                  <div class="mt-6 flex space-x-4">
                    <DangerButton @click="deletePermission(permission.id)">Delete</DangerButton>
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                  </div>
                 </div>
               </Modal>
              </TableDataCell>
            </TableRow>
          </template>
        </Table> -->
      </div>
    </div>
  </AdminLayout>
</template>
