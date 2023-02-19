<script setup>
import Logo from './Logo.vue';

</script>
<template>
    <div class="fixed z-50 h-screen w-screen bg-primary overflow-hidden flex items-center justify-center">
        <div class="flex flex-col justify-center items-center">
            <span class="animate-pulse w-32">
                <Logo color="light" />
            </span>
        </div>
    </div>
</template>