<script setup>
import { ref } from "vue";
import FileUpload from "primevue/fileupload";

const props = defineProps(["formValues"]);

const onUpload = (e) => {
    props.formValues.picture_path = e.taget[0];
    console.log(e);
};
</script>

<template>
    <div class="card flex justify-content-center">
        <FileUpload
            class="bg-white w-full p-3 rounded-md"
            mode="basic"
            name="picture_path"
            chooseLabel="Choisissez une image.."
            chooseIcon="pi pi-fw pi-plus"
            v-model="formValues.picture_path"
            accept="image/*"
            :maxFileSize="2000000"
            customUpload
            @onSelect="onUpload(e)"
        />
    </div>
    <div class="mt-4">
        <Mazinput
            :hint="formValues.errors.password"
            :error="!!formValues.errors.password"
            id="password"
            type="password"
            label="Mot de passe"
            class="mt-1"
            v-model="formValues.password"
            required
            autocomplete="current-password"
        />
    </div>
    <div class="mt-4">
        <Mazinput
            :hint="formValues.errors.password_confirmation"
            :error="!!formValues.errors.password_confirmation"
            id="password_confirmation"
            type="password"
            label="Confirmer mot de passe"
            class="mt-1"
            v-model="formValues.password_confirmation"
            required
            autocomplete="current-password_confirmation"
        />
    </div>
    <div class="flex items-center space-x-2 text-white mt-4">
        <label for="terms">
            <input
                id="terms"
                type="checkbox"
                class="rounded border-0"
                name="terms"
                v-model="formValues.terms"
            />
            <span>
                J'ai lu et j'accepte les termes et conditions generale
                d'utilisations
            </span>
        </label>
    </div>
</template>
