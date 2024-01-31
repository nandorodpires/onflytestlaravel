<template>
  <q-page padding>
    <h5 class="text-center">Nova Despesa</h5>
    <q-form class="justify-center" @submit.prevent="handleExpense">
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

import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'
import useExpense from 'src/composables/UseExpense'

export default defineComponent({
  name: 'ExpenseCreatePage',
  setup() {

    const $q = useQuasar()
    const router = useRouter()
    const { createExpense } = useExpense()

    const form = ref({
      date: null,
      description: null,
      value: null
    })

    const handleExpense = async () => {
      try {
        await createExpense(form.value)
        $q.notify({
          message: 'Despesa cadastrada com sucesso!',
          color: 'green'
        })
        router.push({ name: 'expenses' })
      } catch (error) {
        $q.notify({
          message: 'Ops! Falha ao cadastrar a despesa!',
          color: 'red'
        })
      }
    }

    return { form, handleExpense }

  }
})
</script>
