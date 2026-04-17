import { createRouter, createWebHistory } from 'vue-router'
import { productsRoutesModule } from '@/pages/app/modules/products/routes/routes'
import { categoriesRoutesModule } from '@/pages/app/modules/categories/routes/routes'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: () => import('@/layouts/App.vue'),
            children: [
                {
                    path: '',
                    component: () => import('@/pages/app/index.vue'),
                    name: 'app.index',
                },

                ...productsRoutesModule,
                ...categoriesRoutesModule
            ]
        },

        // not found page
        // {
        //     component: NotFoundPage,
        //     name: 'not-found-page',
        //     path: '/:pathMatch(.*)*',
        // },
    ],
})

export default router
