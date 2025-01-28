<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
</script>

<template>
    <Header/>
    <div></div>
    <div class="mx-auto my-8 max-w-7xl 3xl:max-w-screen-2xl px-4 sm:px-6 lg:px-8">
        <main>
            <slot />
        </main>
    </div>
    <Footer/>
</template>
