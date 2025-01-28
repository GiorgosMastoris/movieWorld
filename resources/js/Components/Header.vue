<template>
    <header class="bg-blue-600 text-white py-4 px-6">
        <div class="flex justify-between items-center">

            <div class="text-2xl font-bold">
                <h1> <Link :href="route('index')"> Movie World </Link></h1>
            </div>

            <div class="hidden md:flex space-x-6">
                <Link :href="route('login')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Login</Link>
                <span class="py-2 rounded-md"> or </span>
                <a :href="route('register')" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Sign Up</a>
            </div>

            <div class="md:hidden">
                <button @click="toggleMenu" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div v-show="isMenuOpen" class="md:hidden bg-blue-600 text-white px-6 py-4 space-y-4">
            <Link :href="route('login')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Login</Link>
            <Link :href="route('register')" class="block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Sign Up</Link>
        </div>
    </header>
</template>


<script>
export default {
    data() {
        return {
            isMenuOpen: false
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
    },
};
</script>
