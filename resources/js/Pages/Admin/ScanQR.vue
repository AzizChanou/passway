<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { QrcodeStream } from "vue3-qrcode-reader";
import { ref, computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import playSound from '@/helpers/playSound'

const isValid = ref(undefined)
const camera = ref("auto")
const result = ref(null)

const success = '/assets/audio/success.mp3'
const error = '/assets/audio/error.mp3'

const validationPending = computed(() => {
    return isValid.value === undefined && camera.value === "off";
});

const validationSuccess = computed(() => {
    return isValid.value === true;
})

const validationFailure = computed(() => {
    return isValid.value === false;
})

const onInit = (promise) => {
    promise.catch(console.error).then(resetValidationState);
};

const resetValidationState = () => {
    isValid.value = undefined;
};

const turnCameraOn = () => {
    camera.value = "auto";
};

const turnCameraOff = () => {
    camera.value = "off";
};

const onDecode = async (content) => {
    result.value = content;

    turnCameraOff();

    console.log(content);

    isValid.value = content.startsWith("hbnjm,");

    if (isValid.value) {
        playSound(success)
        console.log('Code valide');;
    } else {
        playSound(error)
    }

    turnCameraOn();
};
</script>

<template>
    <Head title="QR Code" />
    <AdminLayout>
        <div class="h-full">
            <h1 class="text-2xl px-6 font-bold font-sans">QR Code</h1>
            <div class="px-6 h-[400px] pt-6">
                <QrcodeStream v-if="!validationPending" :camera="camera" @decode="onDecode" @init="onInit">
                    <div v-if="validationSuccess"
                        class="h-full flex flex-col items-center justify-center bg-bouff-primaryfor/80 text-bouff-primaryone text-center text-9xl">
                        <i class="fi-sr-check"></i>
                        <span class="text-lg text-bouff-secondarytwo font-medium">Code valide, patienter un instant !</span>
                    </div>

                    <div v-if="validationFailure"
                        class="h-full text-center text-lg text-bouff-secondarytwo font-medium bg-bouff-primaryfor/60">
                        Code invalide, veuillez réesayer !
                    </div>
                </QrcodeStream>
                <div v-else>
                    <div class="h-full text-center text-lg text-bouff-secondarytwo font-medium bg-bouff-primaryfor/60">
                        Vérification en cours...
                    </div>
                </div>
                <div class="text-center mt-4 text-bouff-secondarytwo text-lg font-bold">
                    Scanner le code pour le valider !
                </div>
            </div>
            <div class="h-28 md:h-0"></div>
        </div>
    </AdminLayout>
</template>
