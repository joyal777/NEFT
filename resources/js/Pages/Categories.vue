<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

// Define the props to accept the categories data
const props = defineProps({
    categories: Array, // Expecting an array of categories
});
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <!-- Header Section -->
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 flex flex-wrap gap-4 items-center">
                <!-- Iterate over categories to create NavLinks -->
                <div
                    v-for="category in props.categories"
                    :key="category.id"
                    class="flex items-center gap-2"
                >
                    <!-- Use the cat_icon for the icon -->
                    <font-awesome-icon :icon="category.cat_icon.split(',')" />
                    <!-- Use the cat_name for the NavLink text -->
                    <NavLink :href="`/categories/${category.id}`">
                        {{ category.cat_name }}
                    </NavLink>
                </div>
            </h2>
        </template>

        <!-- Main Content -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Iterate over categories and display properties as cards -->
                        <div v-for="category in props.categories" :key="category.id" >
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                        {{ category.cat_name }} Properties
                                    </h3>
                                    <NavLink href="" class="text-indigo-900 ml-auto">
                                    
                                        More
                                    </NavLink>
                                </div>


                            <!-- Display only the first 5 properties in a horizontal row -->
                            <div class="flex space-x-6 overflow-hidden">
                                <div
                                    v-for="(property, index) in category.property.slice(0, 5)"
                                    :key="property.id"
                                    class="bg-white border border-gray-200 rounded-lg shadow-lg w-64 h-72 flex flex-col"
                                >
                                    <img
                                        v-if="property.prop_image"
                                        :src="`/front/property_photos/${property.prop_image}`"
                                        alt="Property Image"
                                        class="w-full h-48 object-cover rounded-t-lg overflow-hidden"
                                    />
                                    <div class="p-6 flex flex-col flex-grow">
                                        <div class="flex justify-between items-center">
                                            <p class="text-sm font-semibold text-gray-800 overflow-hidden">
                                                {{ property.prop_name }}
                                            </p>
                                            
                                        </div>
                                        <p
                                            :id="`description-${property.id}`"
                                            class="text-sm text-gray-600 mt-2 overflow-hidden max-h-16 transition-all duration-300 ease-in-out opacity-90"
                                        >
                                            {{ property.description }}
                                        </p>
                                        <div class="mt-auto flex justify-between items-center">
                                            <span
                                                class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold"
                                            >
                                                {{ property.status }}
                                            </span>
                                            <NavLink :href="`/properties/${property.id}`" class="text-blue-500">
                                                View Details
                                            </NavLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Ensure the cards maintain a 4:5 aspect ratio, reducing height */
.card {
  aspect-ratio: 4 / 5;
  max-height: 18rem; /* Adjust the card height */
}

/* Flexbox to ensure buttons stay at the bottom */
.card-body {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}
</style>
