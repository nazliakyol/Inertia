<template>
    <Head title="Users"/>
    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <Link href="/users" class="text-blue-500 text-sm ml-2"> Back </Link>
        </div>
    </div>
    <hr class="mb-6">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="text-lg px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <p class="font-bold">{{ user.name }}</p>
                    <p>{{ user.email }}</p>
                    <p>Registered: {{ user.created_at }}</p>

                </th>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import defineProps from 'vue';

let props = defineProps({
    user: Object
});
</script>
