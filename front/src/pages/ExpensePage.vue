<template>
  <q-page padding>
    <div class="q-pa-md">
      <q-btn class="q-mb-md glossy" to="/expenses/create" color="teal" label="Nova Despesa" />
      <q-table title="Despesas" :rows="expenses" :columns="columns" row-key="name"
        no-data-label="Nenhuma despesa cadastrada.">
        <template v-slot:body="props">
          <q-tr :props="props">
            <q-td key="date" :props="props">
              {{ props.row.date }}
            </q-td>
            <q-td key="description" :props="props">
              {{ props.row.description }}
            </q-td>
            <q-td key="value" :props="props">
              {{ props.row.value }}
            </q-td>
            <q-td key="actions" :props="props">
              <q-btn-dropdown color="primary" label="Ações">
                <q-list>
                  <q-item clickable v-close-popup :to="{ name: 'expenses.update', params: { id: props.row.id } }">
                    <q-item-section clickable v-close-popup>
                      <q-item-label>Editar</q-item-label>
                    </q-item-section>
                  </q-item>

                  <q-item clickable v-close-popup @click="confirmDelete(props.row.id)">
                    <q-item-section>
                      <q-item-label>Excluir</q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-btn-dropdown>
            </q-td>
          </q-tr>
        </template>
      </q-table>
    </div>
  </q-page>
</template>

<script>

import { defineComponent, ref, onMounted } from 'vue'
import { useQuasar } from 'quasar'
import useExpense from 'src/composables/UseExpense'

export default defineComponent({
  name: 'ExpensePage',
  setup() {

    const $q = useQuasar()
    const expenses = ref([])
    const { getExpenses, deleteExpense } = useExpense()
    const columns = [
      { name: 'date', align: 'left', label: 'Data', field: 'date', sortable: true },
      { name: 'description', align: 'left', label: 'Descrição', field: 'description', sortable: true },
      { name: 'value', align: 'left', label: 'Valor', field: 'value', align: 'right', sortable: true },
      { name: 'actions' },
    ]

    onMounted(() => {
      get()
    })

    const get = async () => {
      try {
        expenses.value = await getExpenses()
      } catch (error) {
        $q.notify({
          message: 'Ops! Falha ao listar a despesa!',
          color: 'red'
        })
      }
    }

    const handleDelete = async (id) => {
      try {
        await deleteExpense(id)
        $q.notify({
          message: 'Despesa excluída com sucesso!',
          color: 'green'
        })
        get()
      } catch (error) {
        $q.notify({
          message: 'Ops! Falha ao excluir a despesa!',
          color: 'red'
        })
      }
    }

    const confirmDelete = (id) => {
      $q.dialog({
        title: 'Exluir Despesa',
        message: 'Tem certez que deseja excluir esta despesa?',
        cancel: true,
        persistent: true,
      }).onOk(() => {
        handleDelete(id)
      }).onDismiss(() => {})
    }

    return {
      expenses, columns, confirmDelete
    }
  }
})
</script>
