<script setup lang="ts">
import { ref } from 'vue';

// Props
const props = defineProps({
    accept: {
        type: String,
        default: '*', // Par défaut, accepte tous les types de fichiers
    }
});

// Références
const fileInput = ref<HTMLElement | null>(null);

// Computed
const buttonText = computed(() => props.accept.includes('image/*') ? 'Choisir une image' : 'Choisir un fichier');

// Méthodes
function triggerFileInput() {
    fileInput.value?.click();
}

function handleFileChange(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (files) {

    }
}
</script>

<template>
    <div>
        <input type="file" :accept="accept" @change="handleFileChange" hidden ref="fileInput" />
        <button type="button" @click="triggerFileInput">{{ buttonText }}</button>
        <slot>{{ buttonText }}</slot>
    </div>
</template>
