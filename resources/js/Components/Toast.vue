<script setup>
import { usePage } from "@inertiajs/vue3";
import { useToast } from "maz-ui";
import { onMounted, reactive, ref, watch } from "vue";

const { toast } = useToast();
const page = usePage();
const flash = reactive(page.props.flash);

function showInfo(message) {
    if (message != null) toast.info(message);
}

function showError(message) {
    if (message != null) toast.error(message);
}

function showWarning(message) {
    if (message != null) toast.warning(message);
}

function showSuccess(message) {
    if (message != null) toast.success(message);
}

watch(
    () => flash.success,
    (new_flash) => {
        console.log(new_flash);
        showSuccess(new_flash);
    },
    {
        immediate: true,
    }
);

watch(
    () => flash.error,
    (new_flash) => {
        console.log(new_flash);
        showError(new_flash);
    },
    {
        immediate: true,
    }
);

watch(
    () => flash.info,
    (new_flash) => {
        console.log(new_flash);
        showInfo(new_flash);
    },
    {
        immediate: true,
    }
);

watch(
    () => flash.warning,
    (new_flash) => {
        console.log(new_flash);
        showWarning(new_flash);
    },
    {
        immediate: true,
    }
);
</script>

<template></template>
