<template>
  <q-page padding>
    <h5 class="text-center">Atualizar Despesa</h5>
    <q-form class="justify-center" @submit.prevent="handleUpdate">
      <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-input type="date" label="Data" v-model="form.date" />
        </div>
      </div>
      <div class="row q-pt-md">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-input label="Descrição" v-model="form.description" />
        </div>
      </div>
      <div class="row q-pt-md">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-input label="Valor" v-model="form.value" />
        </div>
      </div>
      <div class="row q-pt-lg">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-btn label="Cadastrar" color="primary" class="full-width" outline rounded size="md" type="submit" />
        </div>
      </div>
    </q-form>
  </q-page>
</template>

<script>

import { defineComponent, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useQuasar } from 'quasar'
import useExpense from 'src/composables/UseExpense'

export default defineComponent({
  name: 'ExpenseUpdatePage',
  setup() {

    const router = useRouter()
    const route = useRoute()
    const $q = useQuasar()
    const { showExpense, updateExpense } = useExpense()
    const id = ref(route.params.id)
    const form = ref({
      date: null,
      description: null,
      value: null
    })

    onMounted(async () => {
      form.value = await showExpense(id.value)
    })

    const handleUpdate = async () => {
      try {
        await updateExpense(form.value, id.value)
        $q.notify({
          message: 'Despesa atualizada com sucesso!',
          color: 'green'
        })
        router.push({ name: 'expenses' })
      } catch (error) {
        $q.notify({
          message: 'Ops! Falha ao atualizar o despesa',
          color: 'negative'
        })
      }
    }

    return { form, handleUpdate }

  }
})
</script>
