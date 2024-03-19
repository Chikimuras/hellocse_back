<script setup lang="ts">
    import {useForm} from "@inertiajs/vue3";
    import InputLabel from "@/Components/InputLabel.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputError from "@/Components/InputError.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

    const form = useForm({
        name: '',
        description: '',
        image: '',
        birthdate: '',
        deathdate: ''
    })

    const handleFileUpload = (event) => {
        form.image = event.target.files[0];
    };

    const submit = () => {
        console.log(form.errors)
        form.post(route('personality.store'));
    };
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-4/12 mx-auto">
            <form @submit.prevent="submit" class="grid grid-cols-12 gap-6">
                <div class="col-span-6">
                    <InputLabel for="image" value="Image" />

                    <input @change="handleFileUpload" class="mt-1 block w-full text-sm text-gray-900 border border-indigo-600 rounded-lg cursor-pointer bg-gray-50 dark:text-indigo-600 focus:outline-none dark:bg-gray-900 dark:border-indigo-600 dark:placeholder-indigo-400" aria-describedby="file_input_help" id="image" type="file">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

                    <InputError class="mt-2" :message="form.errors.image" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="name" value="Nom" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="birthdate" value="Date de naissance" />
                    <TextInput
                        id="birthdate"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.birthdate"
                        required
                        autofocus
                        autocomplete="birthdate"
                    />

                    <InputError class="mt-2" :message="form.errors.birthdate" />
                </div>
                <div class="col-span-6">
                    <InputLabel for="deathdate" value="Date de décès" />
                    <TextInput
                        id="deathdate"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.deathdate"
                        autofocus
                        autocomplete="deathdate"
                    />

                    <InputError class="mt-2" :message="form.errors.deathdate" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="description" value="Description" />
                    <textarea
                        id="description"
                        class="dark:bg-gray-900 dark:text-white mt-1 block w-full rounded-md shadow-sm border-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-indigo-600"
                        v-model="form.description"
                        required
                        autocomplete="description"
                    ></textarea>

                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="col-span-12">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Créer la fiche
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
