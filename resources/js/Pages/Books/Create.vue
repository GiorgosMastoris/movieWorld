<template>
    <div class="flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Submit Your Book
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="submit">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="title" class="sr-only">Title</label>
                        <input id="title" v-model="form.title" name="title" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Title" />
                        <div v-if="errors.title">
                            <div v-for="(error, index) in errors.title" :key="index" class="text-red-500">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="sr-only">Description</label>
                        <textarea id="description" v-model="form.description" name="description" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Description"></textarea>
                        <div v-if="errors.description">
                            <div v-for="(error, index) in errors.description" :key="index" class="text-red-500">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="date_of_publication" class="sr-only">Date of Publication</label>
                        <input id="date_of_publication" v-model="form.date_of_publication" name="date_of_publication" type="date" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" />
                        <div v-if="errors.date_of_publication">
                            <div v-for="(error, index) in errors.date_of_publication" :key="index" class="text-red-500">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({ errors: Object })

const form = useForm({
    title: '',
    description: '',
    date_of_publication: '',
})

const submit = () => {
    form.post(route('books.store'))
}
</script>
