<template>
  <q-page padding>
    <h5 class="text-center">Login</h5>
    <q-form class="justify-center" @submit.prevent="handleLogin">
      <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-input type="email" label="Email" v-model="form.email" />
        </div>
      </div>
      <div class="row q-pt-md">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-input type="password" label="Senha" v-model="form.password" />
        </div>
      </div>
      <div class="row q-pt-lg">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
          <q-btn :loading="loading" @click="simulateProgress()" label="Acessar" color="primary" class="full-width" outline
            rounded size="md" type="submit">
            <template v-slot:loading>
              <q-spinner-hourglass class="on-left" />
              Acessando...
            </template>
          </q-btn>
        </div>
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'
import useAuthUser from 'src/composables/UseAuthUser'

export default defineComponent({
  name: 'LoginPage',
  setup() {

    const $q = useQuasar()
    const router = useRouter()
    const { login } = useAuthUser()

    const loading = ref(null)

    onMounted(() => {

    })

    const form = ref({
      email: '',
      password: ''
    })

    const handleLogin = async () => {
      try {
        if (!form.value.email || !form.value.password) {
          $q.notify({
            message: 'Ops! O e-mail e senha são obrigatórios!',
            color: 'red'
          })
        } else {
          await login(form.value)
          router.push({ name: 'home' })
        }
      } catch (error) {
        console.log();
        $q.notify({
          message: 'Ops! Login e/ou senha inválidos!',
          color: 'red'
        })
      }
    }

    function simulateProgress() {
      // we set loading state
      loading.value = true

      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        loading.value = false
      }, 3000)
    }

    return {
      form, handleLogin, simulateProgress
    }
  }


})
</script>
