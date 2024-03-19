<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps<{
    href: string;
    emphasized?: boolean;
}>();

const classes = computed(() => {
    if (props.emphasized) {
        return 'dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:text-white bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 transition duration-300 ease-in-out';
    }
    return 'dark:bg-transparent dark:hover:bg-indigo-600 dark:text-indigo-600 dark:hover:text-white bg-transparent hover:bg-indigo-700 text-indigo-700 hover:text-white border border-indigo-600 px-4 py-2 transition duration-300 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<style scoped>

</style>
