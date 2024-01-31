import { api } from 'boot/axios'
import { Cookies } from "quasar"

const cookieName = 'onfly_token'
export default function useAuthUser() {
  const login = async ({ email, password }) => {
    const { data } = await api.post('/auth/login', { email, password });
    Cookies.set(cookieName, data.access_token, { expires: data.expires_in })
    return data
  }

  const logout = async () => {
    Cookies.remove(cookieName)
  }

  const isLogged = () => {
    return Cookies.has(cookieName)
  }

  const getToken = () => {
    return Cookies.get(cookieName)
  }

  return {
    login, logout, isLogged, getToken
  }
}
