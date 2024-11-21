<template>
    <Head title="Users"/>
    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-4xl font-bold">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-2"> Add</Link>
        </div>
        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg">
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users.data"
                :key="user.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <Link :href="`/users/${user.id}/show`" class="text-black hover:underline">
                        {{ user.name }}
                    </Link>
                </th>
                <td v-if="user.can.edit" class="px-6 py-4 text-right">
                    <Link :href="`/users/${user.id}/edit`"
                          class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <Pagination :links="users.links" class="mt-6"/>
    <!--    <div style="margin-top: 400px">-->
    <!--        <p>The current time is {{ time }}. </p>-->
    <!--        <Link href="/users" class="text-blue-500 preserve-scroll"> Refresh</Link>-->
    <!--    </div>-->
</template>

<script setup>
import {ref, watch, defineAsyncComponent, onMounted } from 'vue';
import {Inertia} from "@inertiajs/inertia";
import {throttle, debounce} from "lodash";
import {useCurrentUser} from "@/Composables/useCurrentUser";

let Pagination = defineAsyncComponent(() => import('@/Shared/Pagination.vue'))

let props = defineProps({
    users: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(search,
    debounce( function (value) {
    Inertia.get('/users',
        {search: value}, {
            preserveState: true,
            replace: true
        });
}, 300));

onMounted(()=> {
    console.log(useCurrentUser().isALifer());
    // (user.follows({}));
})
</script>
