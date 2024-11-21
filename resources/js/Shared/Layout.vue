<template>
    <Head>
    <title></title>
    <meta
        type="description"
        content="app info"
        head-key="description">
    </Head>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
<!--                 these are not working because page props are not available in the layout-->
<!--                <p class="text-sm ml-4">Latest thread: <link href="#" v-text="$page.props.latestThread.title" /></p>-->
<!--                <p class="text-sm ml-4">Welcome back, {{ username }}!</p>-->
            </div>
            <Nav/>
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot/>
        </div>
    </section>
</template>

<script>
import Nav from "../Shared/Nav.vue";

export default {
    components: {Nav},
    computed: {
        // username() {
        //     return this.$page.props.auth.user.username;
        // }
    },
    mounted() {
        // console.log(this.$page.props);
    }
}
</script>
