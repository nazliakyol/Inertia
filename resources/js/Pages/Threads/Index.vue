<template>

    <Head title="Threads"></Head>
    <div>
        <h1 class="text-4xl font-bold mb-10">Threads</h1>

        <article v-for="thread in threads" :key="thread.id" class="mb-10">
            <header>
                <h1 class="font-bold text-xl"> {{ thread.id }} </h1>
                <h1 class="font-bold text-lg"> {{ thread.title }} </h1>
                <p class="text-xs"> {{ thread.author }}</p>
            </header>
            <div class="mt-3"> {{ thread.body }}</div>
        </article>
    </div>

</template>

<script setup>
defineProps(
    { threads: Object }
)
</script>
