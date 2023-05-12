<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import StepOne from "./Steps/StepOne.vue";
import StepTwo from "./Steps/StepTwo.vue";
import StepThree from "./Steps/StepThree.vue";

const steps = [StepOne, StepTwo, StepThree];
const step = ref(0);
const formError = ref(false);

const form = useForm({
    name: "",
    phone: "",
    email: "",
    organizer_name: "",
    organizer_email: "",
    organizer_phone: "",
    organizer_address: "",
    picture: null,
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onStart: () => console.log(form),
        onError: (err) => console.log(err ? (formError.value = true) : null),
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const next = () => {
    if (step.value < 2) {
        step.value++;
    }
};

const prec = () => {
    if (step.value > 0) {
        step.value--;
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Register" />
        <h3 v-if="formError" class="text-red-400 text-center">
            Il y'a une erreur dans le formulaire
        </h3>
        <form @submit.prevent>
            <div
                class="text-white grid grid-cols-3 gap-4 text-center text-xl p-2 pb-6 cursor-pointer"
            >
                <span
                    @click="step = 0"
                    :class="{ 'border-tertiary text-tertiary': step >= 0 }"
                    class="border-b-2 pb-2"
                    >Utilisateur</span
                >
                <span
                    @click="step = 1"
                    :class="{ 'border-tertiary text-tertiary': step >= 1 }"
                    class="border-b-2 pb-2"
                    >Organisation</span
                >
                <span
                    @click="step = 2"
                    :class="{ 'border-tertiary text-tertiary': step === 2 }"
                    class="border-b-2 pb-2"
                    >Organisation</span
                >
            </div>

            <component :is="steps[step]" :formValues="form" />

            <div class="flex justify-between items-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-slate-400"
                >
                    Déja enregistrer?
                </Link>
                <div class="flex space-x-4">
                    <MazBtn v-if="step > 0" @click="prec"> Precedant </MazBtn>
                    <MazBtn v-if="step < 2" @click="next"> Suivant </MazBtn>
                    <MazBtn
                        @click="submit"
                        v-if="step === 2"
                        :class="{
                            'opacity-25':
                                form.processing ||
                                (form.password === '' &&
                                    form.password !=
                                        form.password_confirmation),
                        }"
                        :disabled="
                            form.processing ||
                            (form.password === '' &&
                                form.password != form.password_confirmation)
                        "
                    >
                        S'enregistrer
                    </MazBtn>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
