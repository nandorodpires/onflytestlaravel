<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn flat dense round icon="menu" aria-label="Menu" @click="toggleLeftDrawer" />

        <q-toolbar-title>
          Onfly Test
        </q-toolbar-title>

        <div>
          <q-btn @click="signOut()">Sair</q-btn>
        </div>

      </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
      <q-list>
        <q-item-label header>
          Menu
        </q-item-label>

        <EssentialLink v-for="link in essentialLinks" :key="link.title" v-bind="link" />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'
import { useRouter } from 'vue-router'
import useAuthUser from 'src/composables/UseAuthUser'

const linksList = [
  {
    title: 'Home',
    caption: '',
    icon: 'home',
    route: { name: 'home' }
  },
  {
    title: 'Despesas',
    caption: '',
    icon: 'payments',
    route: { name: 'expenses' }
  }
]

export default defineComponent({
  name: 'MainLayout',
  components: {
    EssentialLink
  },

  setup() {

    const leftDrawerOpen = ref(false)
    const user = ref(null)
    const router = useRouter()
    const { isLogged, logout } = useAuthUser()

    onMounted(() => {
      if (!isLogged()) router.push({ name: 'login' })
    })

    const signOut = () => {
      logout()
      router.push({ name: 'login' })
    }

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
      signOut
    }
  }
})
</script>
