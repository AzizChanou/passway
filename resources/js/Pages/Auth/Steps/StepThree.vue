<script setup>
import { ref } from 'vue';
import MazDropzone from 'maz-ui/components/MazDropzone'

const props = defineProps(["formValues"]);
const mazDropzoneInstance = ref(null)

const dropzoneOptionsBase = {
    url: '/',
    acceptedFiles: 'image/jpeg,image/jpg,image/png',
    maxFilesize: 2,
    maxFiles: 1,
    maxThumbnailFilesize: 2,
    autoProcessQueue: false,
    autoRemoveOnError: true,
    init: function () {
        this.on('addedfile', function (file) {
            console.log(file.upload.file);
        })
    },
}

const translations = {
    dictDefaultMessage: 'Choisir ou déposer une image',
    dictFilesDescriptions: `(PNG ou JPG de moins de ${dropzoneOptionsBase.maxFilesize} Mo)`,
    dictFallbackMessage: 'Votre navigateur n\'est pas supporté',
    dictFileTooBig: `Image trop volumineux(max : ${dropzoneOptionsBase.maxFilesize} Mo)`,
    dictInvalidFileType: `Type d'image invalide(max : ${dropzoneOptionsBase.maxFilesize} Mo)`,
    dictRemoveFile: 'Supprimer',
    dictCancelUpload: 'Annuler le téléversement',
    dictMaxFilesExceeded: `Vous ne pouvez plus télécharger d'image(max: ${dropzoneOptionsBase.maxFiles})`,
    dictUploadCanceled: 'Téléversement annulé',
}

const dropzoneOptions = Object.assign({}, dropzoneOptionsBase, translations)


mazDropzoneInstance.value?.addedfiles(() => {
    const file = mazDropzoneInstance.value?.getAddedFiles()
    console.log(file);
})

const error = ({ file, message }) => {
    console.log('dropzone-error', { file, message })
}
const success = ({ file, response }) => {
    console.log('dropzone-success', { file, response })
    console.log(props.formValues);
}
</script>

<template>
    <!-- <div>
                                <MazDropzone ref="mazDropzoneInstance" :options="dropzoneOptions" @error="error" @success="success"
                                    @sending="loading = true" @complete="loading = false" :hint="formValues.errors.picture_path" id="picture_path"
                                    label="Logo de l'organisation" v-model="formValues.picture_path" required />
                            </div> -->
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.password" :error="!!formValues.errors.password" id="password" type="password"
            label="Mot de passe" class="mt-1" v-model="formValues.password" required autocomplete="current-password" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.password_confirmation" :error="!!formValues.errors.password_confirmation"
            id="password_confirmation" type="password" label="Confirmer mot de passe" class="mt-1"
            v-model="formValues.password_confirmation" required autocomplete="current-password_confirmation" />
    </div>
    <div class="flex items-center space-x-2 text-white mt-4">
        <MazCheckBox id="terms" class="mt-5" v-model="formValues.terms" required />
        <span>J'ai lu et j'accepte les termes et conditions generale d'utilisations</span>
    </div>
</template>