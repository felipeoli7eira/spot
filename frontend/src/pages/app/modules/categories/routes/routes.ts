import { type RouteRecordRaw } from 'vue-router'

const categoriesRoutesModule: RouteRecordRaw[] = [
    {
        path: 'categorias',
        component: () => import('@/pages/app/modules/categories/index.vue'),
        name: 'app.modules.categories.index',
        alias: ['/categorias'],
    }
]

export { categoriesRoutesModule }
