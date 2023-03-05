<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
});
</script>

<template>
    <div>
        <div>
            <Mazinput :hint="form.errors.name" :error="!!form.errors.name" id="name" type="text" label="Nom" class="mt-1"
                v-model="form.name" required autocomplete="name" />
        </div>
        <div class="mt-4">
            <Mazinput :hint="form.errors.email" :error="!!form.errors.email" id="email" type="email" label="Email"
                class="mt-1" v-model="form.email" required autocomplete="email" />
        </div>
        <div class="mt-4">
            <Mazinput :hint="form.errors.phone" :error="!!form.errors.phone" id="phone" type="text" label="Phone"
                class="mt-1" v-model="form.phone" required autocomplete="phone" />
        </div>
        <div class="mt-4">
            <Mazinput :hint="form.errors.address" :error="!!form.errors.address" id="address" type="text" label="Adresse"
                class="mt-1" v-model="form.address" required autocomplete="address" />
        </div>
        <MazBtn class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Enregistrer
        </MazBtn>
    </div>
</template>