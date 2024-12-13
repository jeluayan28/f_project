<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { MapPinIcon, UsersIcon, CalendarIcon, ChartBarIcon } from '@heroicons/vue/24/outline';

const stats = ref([
  { name: 'Popular Spots', value: '12', icon: MapPinIcon, color: 'bg-emerald-100 text-emerald-600' },
  { name: 'Total Visitors', value: '24,521', icon: UsersIcon, color: 'bg-teal-100 text-teal-600' },
  { name: 'Upcoming Events', value: '7', icon: CalendarIcon, color: 'bg-green-100 text-green-600' },
  { name: 'Growth Rate', value: '8.9%', icon: ChartBarIcon, color: 'bg-lime-100 text-lime-600' },
]);

const topSpots = ref([
  { name: 'Emerald Bay', visitors: 5200, rating: 4.8 },
  { name: 'Green Valley', visitors: 4800, rating: 4.7 },
  { name: 'Cascade Falls', visitors: 4500, rating: 4.9 },
  { name: 'Evergreen Forest', visitors: 4200, rating: 4.6 },
]);
</script>

<template>
  <Head title="Tourist Spot Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-3xl font-bold leading-tight text-emerald-800">
       W A N D E R L U ST
      </h2>
    </template>

    <div class="py-12 bg-gradient-to-br from-green-50 to-emerald-100">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
          <div v-for="item in stats" :key="item.name" 
               class="bg-white overflow-hidden shadow-lg rounded-2xl p-6 transition-all duration-300 hover:shadow-2xl hover:scale-105">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">{{ item.name }}</p>
                <p class="mt-1 text-3xl font-semibold" :class="item.color.split(' ')[1]">{{ item.value }}</p>
              </div>
              <div :class="item.color + ' rounded-full p-3'">
                <component :is="item.icon" class="h-6 w-6" />
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid gap-8 md:grid-cols-2">
          <!-- Top Tourist Spots -->
          <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-emerald-800 mb-4">Top Tourist Spots</h3>
              <div v-for="spot in topSpots" :key="spot.name" class="mb-4 last:mb-0">
                <div class="flex justify-between items-center">
                  <span class="font-medium text-gray-700">{{ spot.name }}</span>
                  <span class="text-sm text-gray-500">{{ spot.visitors.toLocaleString() }} visitors</span>
                </div>
                <div class="mt-1 flex items-center">
                  <div class="flex-1">
                    <div class="h-2 bg-emerald-200 rounded-full">
                      <div class="h-2 bg-emerald-500 rounded-full" :style="{ width: `${(spot.rating / 5) * 100}%` }"></div>
                    </div>
                  </div>
                  <span class="ml-2 text-sm font-medium text-emerald-600">{{ spot.rating }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-emerald-800 mb-4">Quick Actions</h3>
              <div class="grid gap-4 md:grid-cols-2">
                <button class="bg-emerald-600 text-white rounded-lg px-4 py-3 hover:bg-emerald-700 transition-colors duration-300 flex items-center justify-center">
                  <MapPinIcon class="h-5 w-5 mr-2" />
                  Add New Spot
                </button>
                <button class="bg-teal-600 text-white rounded-lg px-4 py-3 hover:bg-teal-700 transition-colors duration-300 flex items-center justify-center">
                  <CalendarIcon class="h-5 w-5 mr-2" />
                  Schedule Event
                </button>
                <button class="bg-green-600 text-white rounded-lg px-4 py-3 hover:bg-green-700 transition-colors duration-300 flex items-center justify-center">
                  <UsersIcon class="h-5 w-5 mr-2" />
                  Manage Visitors
                </button>
                <button class="bg-lime-600 text-white rounded-lg px-4 py-3 hover:bg-lime-700 transition-colors duration-300 flex items-center justify-center">
                  <ChartBarIcon class="h-5 w-5 mr-2" />
                  View Reports
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Welcome Message -->
        <div class="mt-8 bg-white overflow-hidden shadow-xl rounded-2xl">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-emerald-800 mb-4">Welcome to Your Tourist Spot Dashboard</h3>
            <p class="text-gray-600">
              Explore the beauty of nature and culture with our comprehensive tourist spot management system. 
              Monitor visitor trends, upcoming events, and popular destinations all in one place. Use the quick 
              actions above to manage your tourist spots efficiently and effectively.
            </p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.grid > div {
  animation: fadeIn 0.5s ease-out forwards;
}
.grid > div:nth-child(1) { animation-delay: 0.1s; }
.grid > div:nth-child(2) { animation-delay: 0.2s; }
.grid > div:nth-child(3) { animation-delay: 0.3s; }
.grid > div:nth-child(4) { animation-delay: 0.4s; }
</style>