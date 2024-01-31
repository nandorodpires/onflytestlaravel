import { boot } from 'quasar/wrappers'
import axios from 'axios'
import useAuthUser from 'src/composables/UseAuthUser'
const api = axios.create({ baseURL: process.env.API_URL })

export default boot(({ app }) => {

  const { getToken } = useAuthUser()

  api.interceptors.request.use(
    config => {
      const accessToken = getToken()
      config.headers = {
        'Authorization': `Bearer ${accessToken}`,
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Headers': 'Origin, X-Request-Width, Content-Type, Accept',
        'Accept': 'application/json, text/plain, */*'
      }
      return config;
    },
    error => {
      Promise.reject(error)
    });

  app.config.globalProperties.$axios = axios

  app.config.globalProperties.$api = api

})

export { api }
