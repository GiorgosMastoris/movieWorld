<template>
    <div class="flex min-h-screen">
        <div class="flex-1 bg-gray-50 p-6">
            <div v-for="book in books.data" :key="book.id" class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ book.title }}</h3>
                <p class="text-gray-700 text-sm mb-4">{{ book.description }}</p>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>{{ book.name }}</span>
                    <span>{{ new Date(book.date_of_publication).toLocaleDateString() }}</span>
                </div>
                <div class="mt-4 flex justify-between text-sm text-gray-700">
                    <div class="flex items-center">
                        <strong> Likes: </strong>
                        <span class="font-semibold mr-1">{{ book.like }}</span>
                        <strong>| Hates: </strong>
                        <span class="font-semibold mr-1">{{ book.hate }}</span>
                    </div>
                    <div v-if="user && book.user.id != user.id" class="flex items-center">
                        <form @submit.prevent="vote(book.id)">
                            <input type="hidden" v-model="voteForm.book_id">
                            <input type="hidden" v-model="voteForm.type">
                            <button
                                @click="voteForm.type = 'like'"
                                type="submit"
                                :disabled="book.votes.some(vote => vote.user_id === user.id && vote.type === 'like')"
                                class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Like
                            </button>

                            <button
                                @click="voteForm.type = 'hate'"
                                type="submit"
                                :disabled="book.votes.some(vote => vote.user_id === user.id && vote.type === 'hate')"
                                class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Dislike
                            </button>
                        </form>
                    </div>
                </div>
                <form @submit.prevent="applyFilters">
                    <div class="mt-4 flex justify-between text-sm text-gray-700">
                        Posted by
                    </div>
                    <p class="cursor-pointer" @click="setUserIdAndSubmit(book.user.id)">{{ book.user.name }}</p>
                </form>
            </div>

            <Paginator
                :links="books.links"
            />
        </div>

        <div class="w-64 bg-gray-600 text-white p-6">
            <h2 class="text-2xl font-semibold mb-4">
                <Link v-if="user" :href="route('books.create')"
                      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Create Book
                </Link>
            </h2>
            <form @submit.prevent="applyFilters">
                <div class="mb-4">
                    <h2 class="block text-sm font-medium">Sort by</h2><br></br>
                    <div class="flex flex-col">
                        <label for="date_of_publication" class="flex items-center mb-2">
                            <input v-model="filters.sortBy" type="radio" id="date_of_publication" value="date_of_publication" class="h-4 w-4">
                            <span class="ml-2">Date of Publication</span>
                        </label>
                        <label for="like" class="flex items-center mb-2">
                            <input v-model="filters.sortBy" type="radio" id="like" value="like" class="h-4 w-4">
                            <span class="ml-2">Like</span>
                        </label>
                        <label for="hate" class="flex items-center">
                            <input v-model="filters.sortBy" type="radio" id="hate" value="hate" class="h-4 w-4">
                            <span class="ml-2">Hate</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Apply Filters
                </button>
            </form>
            <form @submit.prevent="clearFilters">
                <button type="submit" class="mt-5 w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Reset Filters
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";
import Paginator from "@/Components/Paginator.vue";

defineProps({
    books: Object,
    filters: Object,
})

const page = usePage()
const user = computed(() => page.props.user)

const filters = useForm({
    sortBy: new URLSearchParams(window.location.search).get('sortBy'),
    userId: new URLSearchParams(window.location.search).get('userId'),
});

const voteForm = useForm({
    type: '',
    book_id: '',
});

const vote = (bookId) => {
    voteForm.book_id = bookId;

    voteForm.post(route('book.vote.store'), {
        onSuccess: () => {
            voteForm.reset();
        }
    });
};

const setUserIdAndSubmit = (userId) => {
    filters.userId = userId;
    applyFilters();
};

const applyFilters = () => {
    let filteredForm = {}

    for (const key in filters.data()) if (filters[key]) {
        filteredForm[key] = filters[key]
    }

    filters
        .transform( () => filteredForm )
        .get(route('books.index'), {
            preserveState: true,
            replace: true,
            preserveScroll: true
        })
};

const clearFilterForm = () => {
    for (const key in filters.data()) if (filters[key]) {
        filters[key] = null
    }
}
const clearFilters = () => {
    clearFilterForm()
    applyFilters()
}
</script>
