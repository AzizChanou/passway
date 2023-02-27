<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import StepOne from './Steps/StepOne.vue';
import StepTwo from './Steps/StepTwo.vue';

const steps = [StepOne, StepTwo];
const step = ref(0);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onStart: () => console.log(form),
        onError: (err) => console.log(err),
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const next = () => {
    if (step.value < 1) {
        step.value++
    }
}

const prec = () => {
    if (step.value > 0) {
        step.value--
    }
}

</script>

<template>
    <AuthenticatedLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="text-white grid grid-cols-2 gap-2 text-center text-xl p-2">
                <span :class="{ 'border-tertiary text-tertiary': step >= 0 }" class="col-span-1 border-b-2 pb-2">Etape 1</span>
                <span :class="{ 'border-tertiary text-tertiary': step === 1 }" class="col-span-1 border-b-2 pb-2">Etape 2</span>
            </div>
            <component :is="steps[step]" :formValues="form" />

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-slate-400">
                Already registered?
                </Link>

                <MazBtn v-if="step > 0" @click="prec" class="ml-4">
                    Precedant
                </MazBtn>
                <MazBtn v-if="step < 1" @click="next" class="ml-4">
                    Suivant
                </MazBtn>
                <MazBtn @click="submit" v-if="step === 1" class="ml-4"
                    :class="{ 'opacity-25': form.processing || (form.password === '' && form.password != form.password_confirmation) }"
                    :disabled="form.processing || (form.password === '' && form.password != form.password_confirmation)">
                    S'enregistrer
                </MazBtn>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
