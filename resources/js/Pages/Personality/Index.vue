<script setup lang="ts">
import { Head, Link} from "@inertiajs/vue3";
import GuestLayout from "../../Layouts/GuestLayout.vue";
import Navigation from "@/Pages/Personality/Partials/Navigation.vue";
import {defineProps, onMounted, ref} from "vue";
import PersonalityDetails from "@/Pages/Personality/Partials/PersonalityDetails.vue";

const props = defineProps<{
    canLogin ?: boolean;
    canRegister ?: boolean;
    personalities : Array<any>;
}>();

const selectedPersonality = ref(props.personalities[0]?.id);

const showPersonality = (personalityId: number) => {
    selectedPersonality.value = personalityId;
}

onMounted(() => {
    if (props.personalities.length > 0) {
        selectedPersonality.value = props.personalities[0].id;
    }
});
const defineNavHeight = () => {
    const nav = document.getElementById('personalities-nav');
    const personality_details = document.getElementById('personality-details');
    if (nav) {
        nav.style.height = `${window.innerHeight - 100}px`;
    }
}

// Apply tailwind classes to the navigation
onMounted(() => {
    defineNavHeight();
})

// Apply tailwind classes to the navigation on window resize
window.addEventListener('resize', () => {
    defineNavHeight();
})
</script>

<template>
    <GuestLayout>
        <Head title="Accueil" />
        <div class="grid grid-cols-12">
            <div class="col-span-4">
                <Navigation :personalities="personalities" @showPersonality="showPersonality" />
            </div>
            <div class="col-span-8">
                <PersonalityDetails :personality="personalities.find(personality => personality.id === selectedPersonality)" isLogged/>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
