
const routes = [
  {
    path: '/auth',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      { path: 'login', name: 'login', component: () => import('pages/LoginPage.vue') },
    ]
  },
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: 'home', name: 'home', component: () => import('pages/IndexPage.vue') },
      { path: 'expenses', name: 'expenses', component: () => import('pages/ExpensePage.vue') },
      { path: 'expenses/create', name: 'expenses.create', component: () => import('pages/ExpenseCreatePage.vue') },
      { path: 'expenses/update/:id', name: 'expenses.update', component: () => import('pages/ExpenseUpdatePage.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
