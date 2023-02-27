<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    //console.log(form);
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthenticatedLayout>

        <Head title="S'inscrire" />

        <form @submit.prevent="submit">
            <div>
                <Mazinput :hint="form?.errors?.email" :error="!!form.errors.email" id="email" type="email" label="Email"
                    class="mt-1  " v-model="form.email" required autofocus autocomplete="email" />
            </div>

            <div class="mt-4">
                <Mazinput :hint="form?.errors?.password" :error="!!form.errors.password" id="password" type="password"
                    label="Mot de passe" class="mt-1  " v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="rounded border-0" name="remember" v-model="form.remember" />
                    <span class="ml-2 text-sm text-slate-400">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('password.request')" class="underline text-sm text-slate-400">
                Mot de passe oublié?
                </Link>

                <MazBtn @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Se connecter
                </MazBtn>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
