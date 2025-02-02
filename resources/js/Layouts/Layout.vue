<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import { usePage } from '@inertiajs/vue3'
const { flash } = usePage().props;
</script>

<template>
    <Header/>
    <div></div>
    <div class="mx-auto my-8 max-w-7xl 3xl:max-w-screen-2xl px-4 sm:px-6 lg:px-8">
        <main>
            <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.success }}</span>
            </div>
            <div v-if="$page.props.flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.error }}</span>
            </div>
            <slot />
        </main>
    </div>
    <Footer/>
</template>
