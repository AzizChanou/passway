<script setup>
import { usePage } from '@inertiajs/vue3';
import { useToast } from 'maz-ui';
import { onBeforeMount, onMounted, ref, watch } from 'vue';

const { toast } = useToast();
const page = usePage();

function showInfo(message) {
    toast.info(message)
}

function showError(message) {
    toast.error(message)
}

function showWarning(message) {
    toast.warning(message)
}

function showSuccess(message) {
    toast.success(message)
}

const props = ref(page.props.flash);
showSuccess(newFlash.success)
watch(() => props.value,
    (newFlash) => {
        console.table(newFlash, "Test OKKKKKKKK");
        /*   switch (newFlash) {
              case newFlash.success:
                  showSuccess(newFlash.success);
                  break;
              case newFlash.info:
                  showInfo(newFlash.info);
                  break;
              case newFlash.error:
                  showError(newFlash.error);
                  break;
              case newFlash.warning:
                  showWarning(newFlash.warning);
                  break;
              default:
                  break;
          } */
    },
    { deep: true }
);
</script>

<template></template>