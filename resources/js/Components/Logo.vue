<script setup>
import { computed } from '@vue/reactivity';

const props = defineProps({
    color: "dark",
})

const color = computed(() => {
    if (props.color === 'dark') {
        return "./../../assets/img/logo_dark.svg"
    } else {
        return "./../../assets/img/logo_light.svg"
    }
})
</script>

<template>
    <img :src="color" alt="Logo de Passway">
</template>