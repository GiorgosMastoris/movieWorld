<template>
    <div class="flex min-h-screen">
        <div class="flex-1 bg-gray-50 p-6">
            <div v-for="movie in movies.data" :key="movie.id" class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ movie.title }}</h3>
                <p class="text-gray-700 text-sm mb-4">{{ movie.description }}</p>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>{{ movie.name }}</span>
                    <span>{{ new Date(movie.date_of_publication).toLocaleDateString() }}</span>
                </div>
                <div class="mt-4 flex justify-between text-sm text-gray-700">
                    <div class="flex items-center">
                        <span class="font-semibold mr-1">{{ movie.like }}</span>|
                        <span class="font-semibold mr-1">{{ movie.hate }}</span>
                    </div>
                    <div v-if="user && movie.user_id != user.id" class="flex items-center">
                        <form @submit.prevent="vote(movie.id)">
                            <input type="hidden" v-model="voteForm.movie_id">
                            <input type="hidden" v-model="voteForm.type">

                            <button
                                v-if="alreadyLikeOrHate('like', movie)"
                                @click="voteForm.type = 'like'"
                                type="submit"
                                class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Like
                            </button>

                            <button
                                v-if="alreadyLikeOrHate('hate', movie)"
                                @click="voteForm.type = 'hate'"
                                type="submit"
                                class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Dislike
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4">
                <button
                    @click="changePage(movies.prev_page_url)"
                    :disabled="!movies.prev_page_url"
                    class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600 focus:outline-none">
                    Previous
                </button>

                <span class="text-sm text-gray-700">
                    Page {{ movies.current_page }} of {{ movies.last_page }}
                </span>

                <button
                    @click="changePage(movies.next_page_url)"
                    :disabled="!movies.next_page_url"
                    class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600 focus:outline-none">
                    Next
                </button>
            </div>
        </div>

        <div class="w-64 bg-gray-600 text-white p-6">
            <h2 class="text-2xl font-semibold mb-4">
                <Link v-if="user" :href="route('movie.create')"
                      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Create Movie
                </Link>
            </h2>
            <form @submit.prevent="applyFilters">
                <div class="mb-4">
                    <h2 class="block text-sm font-medium">Sort by</h2><br></br>
                    <div class="flex flex-col">
                        <label for="date_of_publication" class="flex items-center mb-2">
                            <input v-model="filters.sortBy" type="radio" id="date_of_publication" value="date_of_publication" class="h-4 w-4 text-green-600 focus:ring-indigo-500">
                            <span class="ml-2">Date of Publication</span>
                        </label>
                        <label for="like" class="flex items-center mb-2">
                            <input v-model="filters.sortBy" type="radio" id="like" value="like" class="h-4 w-4 text-green-600 focus:ring-indigo-500">
                            <span class="ml-2">Like</span>
                        </label>
                        <label for="dislike" class="flex items-center">
                            <input v-model="filters.sortBy" type="radio" id="dislike" value="dislike" class="h-4 w-4 text-red-600 focus:ring-red-500">
                            <span class="ml-2">Dislike</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Apply Filters
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

defineProps({
    movies: Object
})

const page = usePage()
const user = computed(() => page.props.user)

const filters = useForm({
    sortBy: '',
});

const voteForm = useForm({
    type: '',
    movie_id: '',
});

const vote = (movieId) => {
    voteForm.movie_id = movieId;

    voteForm.post(route('vote.store'), {
        onSuccess: () => {
            voteForm.reset();
        }
    });
};

function alreadyLikeOrHate($type, $movie)
{
    return true;
}
const changePage = (url) => {
    if (url) {
        window.location.href = url;
    }
};

const applyFilters = () => {
    // Filter application logic (optional)
};
</script>
