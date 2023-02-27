<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Renitialiser mot de passe" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <Mazinput :hint="form.errors.password" id="password" type="password" label="Nouveau mot de passe"
                    class="mt-1 w-full" v-model="form.password" autocomplete="password" required />
            </div>
            <div class="mt-4">
                <Mazinput :hint="form.errors.password_confirmation" id="password_confirmation" type="password"
                    label="Confirmer mot de passe" class="mt-1 w-full" v-model="form.password_confirmation"
                    autocomplete="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <MazBtn :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Renitialiser mot de passe
                </MazBtn>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
