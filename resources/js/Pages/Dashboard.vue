<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DashboardCard from "@/Components/DashboardCard.vue";

defineProps({
    sheetCount: Number,
    sheetWrittenCount: Number,
    distinctContributors: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-indigo-600 leading-tight border-b border-indigo-600">Tableau de bord</h2>
        </template>

        <div class="grid grid-cols-12 gap-6 container mx-auto">
            <DashboardCard class="col-span-4 text-center">
                <h3 class="font-thin text-gray-800 dark:text-indigo-600">Nombre de fiches rédigées</h3>

                <p class="text-indigo-600 dark:text-indigo-700 text-4xl font-bold py-6">
                    {{ sheetWrittenCount }}
                </p>
            </DashboardCard>
            <DashboardCard class="col-span-4 text-center">
                <h3 class="font-thin text-gray-800 dark:text-indigo-600">Nombre de fiches total</h3>

                <p class="text-indigo-600 dark:text-indigo-700 text-4xl font-bold py-6">
                    {{ sheetCount }}
                </p>
            </DashboardCard>
            <DashboardCard class="col-span-4 text-center">
                <h3 class="font-thin text-gray-800 dark:text-indigo-600">Nombre de contributeurs</h3>

                <p class="text-indigo-600 dark:text-indigo-700 text-4xl font-bold py-6">
                    {{ distinctContributors }}
                </p>
            </DashboardCard>
        </div>
    </AuthenticatedLayout>
</template>
