<script setup>
const props = defineProps(["formValues"]);
</script>

<template>
    <div>
        <Mazinput :hint="props.formValues.errors.password" :error="!!props.formValues.errors.password" id="password"
            type="password" label="Mot de passe" class="mt-1" v-model="props.formValues.password" required
            autocomplete="current-password" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="props.formValues.errors.password_confirmation"
            :error="!!props.formValues.errors.password_confirmation" id="password_confirmation" type="password"
            label="Confirmer mot de passe" class="mt-1" v-model="props.formValues.password_confirmation" required
            autocomplete="current-password_confirmation" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="props.formValues.errors.password_confirmation"
            :error="!!props.formValues.errors.password_confirmation" id="password_confirmation" type="password"
            label="Confirmer mot de passe" class="mt-1" v-model="props.formValues.password_confirmation" required
            autocomplete="current-password_confirmation" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="props.formValues.errors.password_confirmation"
            :error="!!props.formValues.errors.password_confirmation" id="password_confirmation" type="password"
            label="Confirmer mot de passe" class="mt-1" v-model="props.formValues.password_confirmation" required
            autocomplete="current-password_confirmation" />
    </div>
</template>