<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 flex flex-wrap gap-4 items-center">
                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'city']" />
                    <NavLink>
                        Hotels
                    </NavLink>
                </div>

                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'building']" />
                    <NavLink>
                        Villas
                    </NavLink>
                </div>

                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'landmark']" />
                    <NavLink>
                        Resorts
                    </NavLink>
                </div>

                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'house']" />
                    <NavLink>
                        Homestays
                    </NavLink>
                </div>
                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fab', 'pagelines']" />
                    <NavLink>
                        Farmstays
                    </NavLink>
                </div>
                <div class="flex items-center gap-2">
                    <font-awesome-icon :icon="['fas', 'mountain-sun']" />
                    <NavLink>
                    Forest
                    </NavLink> 
                </div>
                
            </h2>
        </template>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
