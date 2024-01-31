import { api } from 'boot/axios'
export default function useExpense() {

  const route = '/expenses'

  const getExpenses = async () => {
    const { data } = await api.get(route)
    return data
  }

  const showExpense = async (id) => {
    const { data } = await api.get(`${route}/${id}`)
    return data
  }

  const createExpense = async (data) => {
    await api.post(route, data)
  }

  const updateExpense = async (data, id) => {
    await api.put(`${route}/${id}`, data)
  }

  const deleteExpense = async (id) => {
    await api.delete(`${route}/${id}`)
  }

  return {
    getExpenses, createExpense, showExpense, updateExpense, deleteExpense
  }

}
