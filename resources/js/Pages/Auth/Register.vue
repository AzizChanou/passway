<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import StepOne from './Steps/StepOne.vue';
import StepTwo from './Steps/StepTwo.vue';
import StepThree from './Steps/StepThree.vue';

const steps = [StepOne, StepTwo, StepThree];
const step = ref(0);
const formError = ref(false);

const form = useForm({
    name: 'Aziz Abdoul',
    phone: '66485160',
    email: 'azobo@yopmail.fr',
    organizer_name: 'Ultima',
    organizer_email: 'ultima@yopmail.fr',
    organizer_phone: '69457894',
    organizer_address: 'Cotonou, St. Rita',
    picture_path: '',
    password: '96152342',
    password_confirmation: '96152342',
    terms: false,
});

const submit = () => {
    console.log(form);
    /*  form.post(route('register'), {
         onStart: () => console.log(form),
         onError: (err) => console.log(err ? formError.value = true : null),
         onFinish: () => form.reset('password', 'password_confirmation'),
     }); */
};

const next = () => {
    if (step.value < 2) {
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
        <h3 v-if="formError" class="text-red-400 text-center">Il y'a une erreur dans le formulaire</h3>
        <form @submit.prevent>
            <div class="text-white grid grid-cols-3 gap-2 text-center text-xl p-2 cursor-pointer">
                <span @click="step = 0" :class="{ 'border-tertiary text-tertiary': step >= 0 }"
                    class="col-span-1 border-b-2 pb-2">Utilisateur</span>
                <span @click="step = 1" :class="{ 'border-tertiary text-tertiary': step >= 1 }"
                    class="col-span-1 border-b-2 pb-2">Organisation 1</span>
                <span @click="step = 2" :class="{ 'border-tertiary text-tertiary': step === 2 }"
                    class="col-span-1 border-b-2 pb-2">Organisation 2</span>
            </div>

            <component :is="steps[step]" :formValues="form" />

            <div class="flex justify-between items-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-slate-400">
                Already registered?
                </Link>
                <div class="flex space-x-4">
                    <MazBtn v-if="step > 0" @click="prec">
                        Precedant
                    </MazBtn>
                    <MazBtn v-if="step < 2" @click="next">
                        Suivant
                    </MazBtn>
                    <MazBtn @click="submit" v-if="step === 2"
                        :class="{ 'opacity-25': form.processing || (form.password === '' && form.password != form.password_confirmation) }"
                        :disabled="form.processing || (form.password === '' && form.password != form.password_confirmation)">
                        S'enregistrer
                    </MazBtn>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
