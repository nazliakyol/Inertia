<template>
    <Head title="Home"/>
    <h1 class="text-4xl font-bold">Blog</h1>

    <Highlight :code="snippet" class="mt-10"/>
<!--    <div id="example2">-->

<!--    <pre>-->
<!--        <code>-->
<!--            class Home again{-->

<!--            public function construct(){-->
<!--            //-->
<!--            }-->
<!--        }-->
<!--        </code>-->
<!--    </pre>-->
<!--    </div>-->

</template>

<script setup>

import Highlight from "@/Components/Highlight.vue";

let snippet = `
            class Home {

            public function construct(){}
        }
       `.trim();

</script>
