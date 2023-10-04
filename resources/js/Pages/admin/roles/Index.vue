<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DataTable from "@/Components/MyComponents/DataTable2.vue";

defineProps(["roles"]);
const { hasPermission } = usePermission();

const tablekeysheaders= ref({
     'name':'Nombre del rol',
    }
);

const customButtons= ref([{
        label: "Editar",
        action: 'editar',
        permisos: hasPermission('rol update'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    {
        label: "Eliminar",
        action: 'eliminar',
        permisos: hasPermission('rol delete'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);

const tableFiltros= ref([]);

const form = useForm({});

const showConfirmDeleteRoleModal = ref(false);

const confirmDeleteRole = () => {
  showConfirmDeleteRoleModal.value = true;
};

const closeModal = () => {
  showConfirmDeleteRoleModal.value = false;
};

const deleteRole = (id) => {
  form.delete(route("admin.roles.destroy", id), {
    onSuccess: () => closeModal(),
  });
};

const editar = (id) => {
  console.log("hola");
}
</script>

<template>
  <Head title="Dashboard" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end" v-if="hasPermission('rol create')">
        <Link
          :href="route('admin.roles.create')"
          class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
          >Registrar Nuevo Rol</Link
        >
      </div>
      <div class="mt-6">
        <DataTable
        :numerarRow="true"
        :table-keys-headers="tablekeysheaders" 
        :tableData="roles"
        :customButtons="customButtons"
        :tableFiltros="tableFiltros"
        @editar="editar"
        @eliminar="deleteRole"
        />

        <!-- <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <template  v-if="hasPermission('rol update','rol delete')">
                <TableHeaderCell>Action</TableHeaderCell>
              </template>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="role in roles" :key="role.id" class="border-b">
              <TableDataCell v-if="role.id != 1">{{ role.id }}</TableDataCell>
              <TableDataCell v-if="role.id != 1">{{ role.name }}</TableDataCell>
              <TableDataCell v-if="role.id != 1" class="space-x-4">
                <template v-if="hasPermission('rol update')">
                  <Link
                    :href="route('admin.roles.edit', role.id)"
                    class="text-green-400 hover:text-green-600"
                    >Edit</Link
                  >
                </template>
                <template v-if="hasPermission('rol delete')">
                  <button
                    @click="confirmDeleteRole"
                    class="text-red-400 hover:text-red-600"
                  >
                    Delete
                  </button>
                </template>
                <Modal :show="showConfirmDeleteRoleModal" @close="closeModal">
                  <div class="p-6">
                    <h2 class="text-lg font-semibold text-slate-800">
                      Are you sure to delete this Role?
                    </h2>
                    <div class="mt-6 flex space-x-4">
                      <DangerButton @click="deleteRole(role.id)">Delete</DangerButton>
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
