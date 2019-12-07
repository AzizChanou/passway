<script setup>
import { ref } from 'vue'
import MazDropzone from 'maz-ui/components/MazDropzone'
import Dropzone from 'dropzone/dist/dropzone.js';

const props = defineProps({
    picture: null
})

const loading = ref(false)
const mazDropzoneInstance = ref()
const errorMessage = ref()

const error = ({ file, message }) => {
    console.log('dropzone-error', { file, message })
    errorMessage.value = message
}

const success = ({ file, response }) => {
    console.log('dropzone-success', { file, response })
    props.picture = file
    console.log(props.picture);
}

const dropzoneOptionsBase = {
    url: '/upload/image',
    acceptedFiles: 'image/jpeg,image/jpg,image/png',
    maxFilesize: 1,
    maxFiles: 1,
    maxThumbnailFilesize: 1,
    autoProcessQueue: false,
    autoRemoveOnError: false,
}

const translations = {
    dictDefaultMessage: 'Choisissez ou deplacez une image ici',
    dictFilesDescriptions: `(PNG ou JPG en dessous de ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictFallbackMessage: 'Votre navigateur n\'est pas supporte !',
    dictFileTooBig: `Votre fichier est trop gros (max: ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictInvalidFileType: `Votre fichier est trop gros (max: ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictRemoveFile: 'Retirer',
    dictCancelUpload: 'Annuler l\'envoie',
    dictMaxFilesExceeded: `You can not upload any more files. (max: ${dropzoneOptionsBase.maxFiles})`,
    dictUploadCanceled: 'Televersement annuler',
    autoProcessQueue: true
}

const dropzoneOptions = {
    ...dropzoneOptionsBase,
    ...translations
}

</script>

<template>
    <MazDropzone ref="mazDropzoneInstance" :options="dropzoneOptions" @error="error" @success="success"
        @sending="loading = true" @complete="loading = false" />
</template>