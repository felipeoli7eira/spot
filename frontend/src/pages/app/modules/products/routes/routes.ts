import { type RouteRecordRaw } from 'vue-router'

const productsRoutesModule: RouteRecordRaw[] = [
    {
        path: 'produtos',
        component: () => import('@/pages/app/modules/products/index.vue'),
        name: 'app.modules.products.index',
        alias: ['/produtos'],
    }
]

export { productsRoutesModule }
