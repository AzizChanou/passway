<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';

const playSound = () => {
    var audio = new Audio('assets/audio/success.mp3');
    audio.play();
}
</script>

<template>
    <AdminLayout>
        <button @click="playSound">Play</button>
    </AdminLayout>
</template>