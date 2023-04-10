<script setup>
const props = defineProps(["formValues"]);
</script>

<template>
    <div>
        <Mazinput :hint="formValues.errors.name" :error="!!formValues.errors.name" id="name" type="text"
            label="Nom & Prénoms" class="mt-1" v-model="formValues.name" required autocomplete="name" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.phone" :error="!!formValues.errors.phone" id="phone" type="text"
            label="Numéro de téléphone" class="mt-1" v-model="formValues.phone" required autocomplete="phone" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.email" :error="!!formValues.errors.email" id="email" type="email" label="Email"
            class="mt-1" v-model="formValues.email" required autocomplete="email" />
    </div>
</template>