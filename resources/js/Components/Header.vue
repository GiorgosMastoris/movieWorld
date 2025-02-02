<template>
    <header class="bg-blue-600 text-white py-4 px-6">
        <div class="flex justify-between items-center">
            <div class="text-2xl font-bold">
                <h1> <Link :href="route('index')"> Movie World </Link></h1>
            </div>

            <div v-if="!user" class="hidden md:flex space-x-6">
                <Link :href="route('login')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Login</Link>
                <span class="py-2 rounded-md"> or </span>
                <a :href="route('register')" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Sign Up</a>
            </div>

            <div v-if="user" class="hidden md:flex space-x-6">
                <p class="block text-white py-2 px-4">Welcome back {{user.name.charAt(0).toUpperCase() + user.name.slice(1)}}</p>
                <button @click="logout"  class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Logout</button>
            </div>

            <div class="md:hidden">
                <button @click="toggleMenu" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div v-show="isMenuOpen"   class="md:hidden bg-blue-600 text-white px-6 py-4 space-y-4">
            <Link v-if="!user" :href="route('login')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Login</Link>
            <Link v-if="!user" :href="route('register')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Sign Up</Link>
            <button v-if="user" @click="logout"  class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Logout</button>
        </div>
    </header>
</template>


<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const isMenuOpen = ref(false)
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}
const logout = () => {
    router.post(route('logout'))
}

const page = usePage()
const user = computed(() => page.props.user)
</script>

