<script setup>
import {computed} from "vue";

const props = defineProps({ status: Number })

const title = computed(() => {
    return {
        503: '503: Service Unavailable\n',
        500: '500: Server Error\n',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[props.status]
});

const description = computed(() => {
    return {
        503: 'Sorry, we are undergoing some maintenance. Please check back soon.',
        500: 'Oops, something went wrong with our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
});
</script>

<template>
    <div>
        <div class="mx-auto mt-8 mb-24">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl ">{{ title }}</h2>
            </div>
            <div class="mx-auto text-center mt-10">
                {{ description }}
            </div>
        </div>
    </div>
</template>
