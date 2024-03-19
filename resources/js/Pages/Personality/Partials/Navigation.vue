<script setup lang="ts">
import {onMounted} from "vue";

defineProps<{
    personalities : Array<{ id: number, name: string }>;
}>()

const emit = defineEmits<{
    showPersonality: (personalityId: number) => void;
}>()
</script>

<template>
    <div id="personalities-nav" class="flex flex-col gap-4 overflow-y-auto scroll-smooth snap-y snap-end mt-[50px]">
        <a @click="emit('showPersonality', personality.id)" class="flex-1 py-2 px-2 bg-gray-800 inline-flex item-center justify-center" v-for="personality in personalities" :key="personality.id">
            <span class="text-xs" >{{ personality.name }}</span>
        </a>
    </div>
</template>

<style scoped>
    ::-webkit-scrollbar {
        width: 5px;
    }
    ::-webkit-scrollbar-thumb {
        background-color: rgb(55 48 163);
        border-radius: 10px;
    }
</style>
