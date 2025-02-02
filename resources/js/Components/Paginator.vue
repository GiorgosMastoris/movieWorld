<template>
    <nav v-if="links.length > 3" class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0 mt-8">
        <div class="flex flex-wrap items-center justify-center w-full">
            <div v-for="(link, key) in links" :key="key">
                <a v-if="link.url === null" href="#" class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700" v-html="link.label"></a>
                <Link v-else :class="{ 'border-indigo-500 text-indigo-600': link.active, 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': !link.active }" :href="link.url" class="inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium" v-html="link.label"></Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    }
});
</script>
