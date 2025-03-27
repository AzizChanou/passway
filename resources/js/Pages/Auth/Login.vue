<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "kyogre@yopmail.fr",
  password: "password",
  remember: true,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="S'inscrire" />

    <form @submit.prevent="submit" class="flex flex-col gap-4 w-full">
      <Mazinput
        :hint="form?.errors?.email"
        :error="!!form.errors.email"
        id="email"
        type="email"
        label="Email"
        class="mt-1 w-full"
        v-model="form.email"
        required
        autofocus
        autocomplete="email"
      />

      <Mazinput
        :hint="form?.errors?.password"
        :error="!!form.errors.password"
        id="password"
        type="password"
        label="Mot de passe"
        class="mt-1 w-full"
        v-model="form.password"
        required
        autocomplete="current-password"
      />

      <div class="block mt-4">
        <label class="flex items-center">
          <input
            type="checkbox"
            class="rounded border-0"
            name="remember"
            v-model="form.remember"
          />
          <span class="ml-2 text-sm text-slate-400">Remember me</span>
        </label>
      </div>

      <div class="flex justify-between items-center mt-4">
        <Link
          :href="route('password.request')"
          class="underline text-sm text-slate-400"
        >
          Mot de passe oublié?
        </Link>

        <MazBtn
          @click="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Se connecter
        </MazBtn>
      </div>
      <div class="flex flex-col items-center space-y-3 text-sm text-slate-400">
        <span>ou</span>
        <Link :href="route('register')" class="underline">
          Créer un compte?
        </Link>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
