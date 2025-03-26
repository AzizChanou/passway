<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { QrcodeStream } from "vue-qrcode-reader";
import { ref, computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import playSound from "@/helpers/playSound";

const props = defineProps({
  is_used: null,
});

const isValid = ref(undefined);
const isLoading = ref(false);
const success = "/assets/audio/success.mp3";
const error = "/assets/audio/error.mp3";
const scanForm = useForm({
  code: null,
});

const validationSuccess = computed(() => {
  return isValid.value === true;
});

const validationFailure = computed(() => {
  return isValid.value === false;
});

const resetValidationState = () => {
  isValid.value = undefined;
};

const onDetecte = async (content) => {
  scanForm.code = content[0].rawValue;
  isLoading.value = true;
  scanForm.post(route("qrcode.scan"), {
    onSuccess: (response) => {
      if (response.props.is_used) isValid.value = false;
      else isValid.value = true;
      playSound(success);
    },
    onError: () => {
      isValid.value = false;
      playSound(error);
    },
    onFinish: () => {
      isLoading.value = false;
      setTimeout(() => {
        isValid.value = undefined;
      }, 1000);
    },
  });
};
</script>

<template>
  <Head title="QR Code" />
  <AdminLayout>
    <div class="h-full">
      <h1 class="text-2xl px-6 font-bold font-sans">QR Code</h1>
      <div class="px-6 h-[400px] pt-6 rounded-md">
        <QrcodeStream
          :paused="isLoading"
          @detect="onDetecte"
          @camera-on="resetValidationState"
        >
          <div
            v-if="validationSuccess"
            class="h-full w-full absolute flex items-center justify-center bg-green-500 text-white text-center text-9xl"
          >
            <div class="flex flex-col">
              <i class="fi-sr-check text-9xl"></i>
              <span class="text-lg text-bouff-secondarytwo font-medium"
                >Code valide, patienter un instant !</span
              >
            </div>
          </div>

          <div
            v-else-if="validationFailure"
            class="h-full w-full absolute flex items-center justify-center text-center text-lg text-white font-medium bg-red-900"
          >
            <div class="flex flex-col">
              <i class="fi-sr-cross-small text-9xl"></i>
              <span>Code utilisé ou invalide, veuillez réesayer !</span>
            </div>
          </div>

          <div
            v-else-if="isLoading"
            class="h-full w-full absolute flex items-center justify-center text-center text-lg text-white font-medium bg-yellow-500"
          >
            <div class="flex flex-col">
              <i class="fi-sr-loading text-9xl animate-spin"></i>
              <span>Vérification en cours...</span>
            </div>
          </div>
        </QrcodeStream>

        <div class="text-center mt-4 text-primary text-lg font-bold">
          Scanner le code pour valider le ticket !
        </div>
      </div>
      <div class="h-28 md:h-0"></div>
    </div>
  </AdminLayout>
</template>
