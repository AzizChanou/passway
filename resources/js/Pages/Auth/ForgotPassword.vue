<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Mot de passe oublié" />

        <div class="mb-4 text-sm text-slate-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4">
                <Mazinput :hint="form.errors.email" id="email" type="email" label="Email" class="mt-1  "
                    v-model="form.email" autocomplete="email" required />
            </div>
            <div class="flex items-center justify-end mt-4">
                <MazBtn :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Récupérer mot de passe
                </MazBtn>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
