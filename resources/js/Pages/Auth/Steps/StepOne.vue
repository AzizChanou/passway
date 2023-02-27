<script setup>
import { ref } from 'vue'
import MazDropzone from 'maz-ui/components/MazDropzone'
const props = defineProps(["formValues"]);

const loading = ref(false)
const mazDropzoneInstance = ref(null)
const errorMessage = ref('')

const error = ({ file, message }) => {
    console.log('dropzone-error', { file, message })
    errorMessage.value = message
}
const success = ({ file, response }) => {
    console.log('dropzone-success', { file, response })
}
const sendFiles = () => mazDropzoneInstance.value.processQueue()

const dropzoneOptionsBase = {
    url: 'https://httpbin.org/post',
    headers: { 'My-Awesome-Header': 'header value' },
    acceptedFiles: 'image/jpeg,image/jpg,image/png',
    maxFilesize: 5,
    maxFiles: 1,
    maxThumbnailFilesize: 3,
    autoProcessQueue: false,
    autoRemoveOnError: true,
}

const translations = {
    dictDefaultMessage: 'Choose or drop a file',
    dictFilesDescriptions: `(PNG or JPG under ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictFallbackMessage: 'Your browser is not supported',
    dictFileTooBig: `File(s) too big (max: ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictInvalidFileType: `File(s) too big (max: ${dropzoneOptionsBase.maxFilesize} MB)`,
    dictRemoveFile: 'Remove',
    dictCancelUpload: 'Cancel upload',
    dictMaxFilesExceeded: `You can not upload any more files. (max: ${dropzoneOptionsBase.maxFiles})`,
    dictUploadCanceled: 'Upload canceled',
}

const dropzoneOptions = Object.assign({}, dropzoneOptionsBase, translations)
</script>

<template>
    <div>
        <Mazinput :hint="formValues.errors.name" :error="!!formValues.errors.name" id="name" type="text" label="Nom"
            class="mt-1" v-model="formValues.name" required autocomplete="name" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.email" :error="!!formValues.errors.email" id="email" type="email" label="Email"
            class="mt-1" v-model="formValues.email" required autocomplete="email" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.phone" :error="!!formValues.errors.phone" id="phone" type="text" label="Phone"
            class="mt-1" v-model="formValues.phone" required autocomplete="phone" />
    </div>
    <div class="mt-4">
        <Mazinput :hint="formValues.errors.address" :error="!!formValues.errors.address" id="address" type="text"
            label="Adresse" class="mt-1" v-model="formValues.address" required autocomplete="address" />
    </div>
    <div class="mt-4">
        <!--  <MazDropzone ref="mazDropzoneInstance" :options="dropzoneOptions" @error="error" @success="success"
                        @sending="loading = true" @complete="loading = false" :hint="props.formValues.errors.address" id="address"
                        type="text" label="Adresse" class="mt-1 h-16" v-model="props.formValues.address" required
                        autocomplete="address" /> -->
    </div>
</template>