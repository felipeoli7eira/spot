<script setup lang="ts">
import { ref } from 'vue'
import FullScreenLoader from '@/components/FullScreenLoading/index.vue'

import { LogOut, HomeIcon, Bell, Tags, Archive, Package2, Users, PanelLeftOpen, PanelRightOpen } from 'lucide-vue-next'

const sidebarIsOpen = ref(false)

const toggleSidebarOpenState = () => {
    sidebarIsOpen.value = !sidebarIsOpen.value
}

</script>

<template>
    <div class="layout-default h-screen flex py-5 pr-6 bg-base-200">
        <!-- <FullScreenLoader v-if="checkingAuthentication" message="Verificando credenciais..." /> -->

        <header class="p-2 flex flex-col items-center h-full">
            <nav class="flex flex-col gap-2 flex-1 items-start justify-center relative">
                <RouterLink role="button" :to="{ name: 'app.index' }"
                    class="flex items-center w-full rounded-sm gap-4 hover:bg-base-100" exact-active-class="bg-primary">
                    <div class="p-3 rounded-sm">
                        <HomeIcon :size="20" class="" />
                    </div>

                    <div v-if="sidebarIsOpen" class="span pr-3">Dashboard</div>
                </RouterLink>

                <RouterLink role="button" :to="{ name: 'app.modules.products.index' }"
                    class="flex w-full items-center rounded-sm gap-4 hover:bg-base-100" exact-active-class="bg-primary">
                    <div class="p-3 rounded-sm">
                        <Package2 :size="20" />
                    </div>

                    <div v-if="sidebarIsOpen" class="span pr-3">Produtos</div>
                </RouterLink>

                <RouterLink role="button" :to="{ name: 'app.modules.categories.index' }"
                    class="flex w-full items-center rounded-sm gap-4 hover:bg-base-100" exact-active-class="bg-primary">
                    <div class="p-3 rounded-sm">
                        <Tags :size="20" />
                    </div>

                    <div v-if="sidebarIsOpen" class="span pr-3">Categorias</div>
                </RouterLink>

                <!--  -->

                <button @click="toggleSidebarOpenState"
                    class="absolute -right-6.5 bg-primary hover:bg-base-300 hover:cursor-pointer transition-all duration-100 ease-in top-1/5 flex items-center justify-center rounded-full h-10 w-10"
                    type="button">
                    <PanelLeftOpen v-if="!sidebarIsOpen" :size="20" />
                    <PanelRightOpen v-else :size="20" />
                </button>
            </nav>
        </header>

        <div class="flex-1 rounded-2xl flex flex-col">
            <div class="overflow-y-auto bg-base-100 rounded-2xl shadow-lg flex-1 p-5 px-10">
                <RouterView />
            </div>
        </div>
    </div>
</template>
