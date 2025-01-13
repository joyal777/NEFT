<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';

// Define the props to accept the categories data
const props = defineProps({
    categories: Array, // Expecting an array of categories
});

// State for the modal and selected property
const isBookingModalOpen = ref(false);
const selectedProperty = ref(null);

// Booking form state
const bookingForm = ref({
    name: '',
    email: '',
    checkin_date: '',
    checkout_date: '',
});

// Function to open the booking modal
function openBookingModal(property) {
    selectedProperty.value = property;
    isBookingModalOpen.value = true;
}

// Function to close the booking modal
function closeBookingModal() {
    isBookingModalOpen.value = false;
    selectedProperty.value = null;
    bookingForm.value = {
        name: '',
        email: '',
        checkin_date: '',
        checkout_date: '',
    };
}

// Function to handle booking form submission
function submitBooking() {
    if (!selectedProperty.value) return;

    // Example submission logic
    console.log('Booking Submitted:', {
        property_id: selectedProperty.value.id,
        ...bookingForm.value,
    });

    // Reset form and close modal
    closeBookingModal();
}
</script>


<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <!-- Header Section -->
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 flex flex-wrap gap-4 items-center">
                <div
                    v-for="category in props.categories"
                    :key="category.id"
                    class="flex items-center gap-2"
                >
                    <font-awesome-icon :icon="category.cat_icon.split(',')" />
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
                        <div v-for="category in props.categories" :key="category.id">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    {{ category.cat_name }} Properties
                                </h3>
                                <NavLink href="" class="text-indigo-900 ml-auto">
                                    More
                                </NavLink>
                            </div>
                            <div class="flex space-x-6 overflow-hidden">
                                <div
                                    v-for="property in category.property.slice(0, 5)"
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
                                            <p class="text-green-600 font-semibold">
                                                ₹ {{ property.prop_price }}
                                            </p>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2 overflow-hidden max-h-16">
                                            {{ property.description }}
                                        </p>
                                        <div class="mt-auto flex justify-between items-center">
                                            <button 
                                                @click="openBookingModal(property)" 
                                                class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold"
                                            >
                                                Book now
                                            </button>
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

        <!-- Booking Modal -->
        <div 
                v-if="isBookingModalOpen" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                @click.self="closeBookingModal"
            >
                <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-8 relative">
                    <!-- Close Button -->
                    <button 
                        @click="closeBookingModal" 
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition"
                        aria-label="Close Modal"
                    >
                        &times;
                    </button>

                    <div class="flex space-x-8">
                        <!-- Left Section: Property Details -->
                        <div class="w-1/2">
                            <img 
                                v-if="selectedProperty?.prop_image" 
                                :src="`/front/property_photos/${selectedProperty.prop_image}`" 
                                alt="Property Image" 
                                class="w-full h-64 object-cover rounded-lg"
                            />
                            <h3 class="text-2xl font-bold mt-4">{{ selectedProperty?.prop_name }}</h3>
                            <p class="text-gray-600 mt-2">{{ selectedProperty?.description }}</p>
                            <p class="text-green-600 font-semibold mt-4 text-xl">₹ {{ selectedProperty?.prop_price }}</p>
                        </div>

                        <!-- Right Section: Booking Form -->
                        <div class="w-1/1">
                            <h4 class="text-xl font-semibold mb-4">Booking Details</h4>
                            <form @submit.prevent="submitBooking" class="space-y-4">
                                <div class="flex space-x-6">
                                    <div class="w-1/2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input 
                                            type="text" 
                                            id="name" 
                                            v-model="bookingForm.name" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-3 py-2"
                                            required
                                        />
                                    </div>
                                    <div class="w-1/2">
                                        <label for="checkin" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                                        <input 
                                            type="date" 
                                            id="checkin" 
                                            v-model="bookingForm.checkin_date" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-3 py-2"
                                            required
                                        />
                                        </div>
                                    <div class="w-1/2">
                                        <label for="checkout" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                                        <input 
                                            type="date" 
                                            id="checkout" 
                                            v-model="bookingForm.checkout_date" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-3 py-2"
                                            required
                                        />
                                        
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input 
                                            type="email" 
                                            id="email" 
                                            v-model="bookingForm.email" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-3 py-2"
                                            required
                                        />
                                    </div>
                                    <div class="w-1/2">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input 
                                            type="text" 
                                            id="phone" 
                                            v-model="bookingForm.phone" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm px-3 py-2"
                                            required
                                        />
                                    </div>
                                </div>
                                <button 
                                    type="submit" 
                                    class="bg-blue-500 text-white px-6 py-3 rounded-lg w-full font-semibold hover:bg-blue-600 transition"
                                >
                                    Confirm Booking
                                </button>
                            </form>
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
