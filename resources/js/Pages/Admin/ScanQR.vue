<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { QrcodeStream } from "qrcode-reader-vue3";
import { ref, computed, onUpdated, onMounted } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import playSound from "@/helpers/playSound";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    is_used: null,
});

const isValid = ref(undefined);
const isTicket = ref(null);
const camera = ref("auto");
const success = "/assets/audio/success.mp3";
const error = "/assets/audio/error.mp3";
const scanForm = useForm({
    code: null,
});

onUpdated(() => {
    isValid.value = props.is_used;
    console.log(props.is_used);
});

const validationPending = computed(() => {
    return isValid.value == undefined && camera.value === "off";
});

const validationSuccess = computed(() => {
    return isValid.value === true;
});

const validationFailure = computed(() => {
    return isValid.value === false;
});

const onInit = (promise) => {
    promise.catch(console.error).then(resetValidationState);
};

const resetValidationState = () => {
    isValid.value = undefined;
};

const turnCameraOn = () => {
    camera.value = "auto";
    console.log("Camera on");
};

const turnCameraOff = () => {
    camera.value = "off";
    console.log("Camera off");
};

const onDecode = async (content) => {
    turnCameraOff();

    isTicket.value = await content.startsWith("pass");

    if (isTicket.value) {
        scanForm.post(route("qrcode.scan"), {
            onSuccess: () => playSound(success),
        });
        isValid.value = true;
        /*  try {
            const response = router.post(
                route("qrcode.scan"),
                { code: content },
                {
                    replace: false,
                    preserveState: false,
                    preserveScroll: false,
                }
            );
        } catch (error) {
            console.error(error);
        } */
    } else {
        playSound(error);
        isValid.value = false;
        setTimeout(() => {
            isValid.value = undefined;
        }, 1000);
    }

    turnCameraOn();
};
</script>

<template>
    <Head title="QR Code" />
    <AdminLayout>
        <div class="h-full">
            <h1 class="text-2xl px-6 font-bold font-sans">QR Code</h1>
            <div class="px-6 h-[400px] pt-6 rounded-md">
                <div
                    v-if="validationSuccess"
                    class="h-full flex items-center justify-center bg-green-500 text-white text-center text-9xl"
                >
                    <div class="flex flex-col">
                        <i class="fi-sr-check text-9xl"></i>
                        <span
                            class="text-lg text-bouff-secondarytwo font-medium"
                            >Code valide, patienter un instant !</span
                        >
                    </div>
                </div>

                <div
                    v-else-if="validationFailure"
                    class="h-full flex items-center justify-center text-center text-lg text-white font-medium bg-red-900"
                >
                    <div class="flex flex-col">
                        <i class="fi-sr-cross-small text-9xl"></i>
                        <span>Code invalide, veuillez réesayer !</span>
                    </div>
                </div>

                <div
                    v-else-if="validationPending"
                    class="h-full flex items-center justify-center text-center text-lg text-white font-medium bg-yellow-500"
                >
                    <div class="flex flex-col">
                        <i class="fi-sr-loading text-9xl animate-spin"></i>
                        <span>Vérification en cours...</span>
                    </div>
                </div>
                <QrcodeStream
                    v-else
                    :camera="camera"
                    @decode="onDecode"
                    @init="onInit"
                />
                <div class="text-center mt-4 text-primary text-lg font-bold">
                    Scanner le code pour valider le ticket !
                </div>
            </div>
            <div class="h-28 md:h-0"></div>
        </div>
    </AdminLayout>
</template>
