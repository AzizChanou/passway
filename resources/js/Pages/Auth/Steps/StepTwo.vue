<script setup>
const props = defineProps(["formValues"]);
</script>

<template>
    <div>
        <Mazinput :hint="formValues.errors.organizer_name" :error="!!formValues.errors.organizer_name" id="organizer_name"
            type="text" label="Nom de l'organisation" class="mt-1" v-model="formValues.organizer_name" required
            autocomplete="organizer_name" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.organizer_email" :error="!!formValues.errors.organizer_email"
            id="organizer_email" type="email" label="Email de l'organisation" class="mt-1"
            v-model="formValues.organizer_email" required autocomplete="organizer_email" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.organizer_phone" :error="!!formValues.errors.organizer_phone"
            id="organizer_phone" type="text" label="Telephone de l'organisation" class="mt-1"
            v-model="formValues.organizer_phone" required autocomplete="organizer_phone" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.organizer_address" :error="!!formValues.errors.organizer_address"
            id="organizer_address" type="text" label="Adresse de l'organisation" class="mt-1"
            v-model="formValues.organizer_address" required autocomplete="organizer_address" />
    </div>
</template>