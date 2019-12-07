<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    eventCategories: {}
})

const userForm = useForm({
    name: '',
    email: '',
    role: '',
    password: '',
    confirm_password: '',
    picture: null
})
const submitEvent = () => {
    console.log(userForm);
}
</script>

<template>
    <Head title="Creer un assistant" />
    <GuestLayout>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md">
                <h2 class="text-xl font-medium">Evenement</h2>
                <form @submit.prevent="submitEvent" class="grid grid-cols-6 gap-4 col-span-full">
                    <div class="col-span-full sm:col-span-3">
                        <label for="name" class="text-sm">Nom</label>
                        <input v-model="userForm.name" id="name" type="text" placeholder="Nom" min="1"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="userForm.errors.name">
                            {{ userForm.errors.name }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="email" class="text-sm">Email</label>
                        <input v-model="userForm.email" id="email" type="email" placeholder="Email"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="userForm.errors.email">
                            {{ userForm.errors.email }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="role" class="text-sm">Role de l'utilisateur</label>
                        <select v-model="userForm.role" id="role"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required>
                            <option disabled>--Selectionner un role--</option>
                            <option value="amin"> Administrateur </option>
                            <option value="assistant"> Assistant </option>
                        </select>
                        <div class="text-sm text-red-600" v-if="userForm.errors.role">
                            {{ userForm.errors.role }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="password" class="text-sm">Mot de passe</label>
                        <input v-model="userForm.password" id="password" type="text" placeholder="Mot de passe"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="userForm.errors.password">
                            {{ userForm.errors.password }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="confirm_password" class="text-sm">Confirmer mot de passe</label>
                        <input v-model="userForm.confirm_password" id="confirm_password" type="text" placeholder="Confirmer mot de passe"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="userForm.errors.confirm_password">
                            {{ userForm.errors.confirm_password }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <button
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded">Acheter</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </GuestLayout>
</template>