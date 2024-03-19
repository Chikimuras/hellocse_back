<script setup lang="ts">
import {onRenderTriggered} from "vue";
import {Link} from "@inertiajs/vue3";
import LinkedButton from "@/Components/LinkedButton.vue";

const props = defineProps<{
    personality: {
        id: number,
        name: string,
        description: string,
        image: string,
        color: string,
        birthdate: string,
        deathdate?: string,
        created_at: string,
        updated_at: string,
    },
    isLogged?: boolean
}>();

//Get the root url
const rootUrl = window.location.origin+'/';

const calculateAge = (birthdate: string, deathdate ?: string) => {
    const birth = new Date(birthdate);
    const deathOrNow = deathdate ? new Date(deathdate) : new Date();
    const age = deathOrNow.getFullYear() - birth.getFullYear();
    const m = deathOrNow.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && deathOrNow.getDate() < birth.getDate())) {
        return age - 1;
    }
    return age;
}

</script>

<template>
    <div id="personality-details" class="mt-[50px] px-12 overflow-y-auto scroll-smooth snap-y snap-end">
        <div v-if="isLogged" class="flex justify-end mb-4 gap-4">
            <LinkedButton :href="route('personality.edit', {personality: personality.id})">Modifier</LinkedButton>
            <LinkedButton :href="route('personality.create')" emphasized>Ajouter une personnalité</LinkedButton>
        </div>
        <div class="flex items-center mb-16">
            <img :src="'/'+personality.image" :alt="personality.name" class="w-1/2 mx-auto" />
            <div>
                <h1 class="text-4xl text-indigo-600">{{ personality.name }}</h1>
                <p class="text-gray-500">Né.e le {{ new Date(personality.birthdate).toLocaleDateString()}} <span v-if="personality.deathdate">décédé.e le {{ new Date(personality.deathdate).toLocaleDateString() }}</span> {{ calculateAge(personality.birthdate, personality.deathdate) }} ans</p>
            </div>
        </div>
        <p>{{ personality.description }}</p>
    </div>
</template>

<style scoped>

</style>
