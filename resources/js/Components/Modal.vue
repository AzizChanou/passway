<template>
    <MazBtn @click="isOpen = true">Open Dialog</MazBtn>

    <MazDialog v-model="isOpen" title="Dialog Title">
        <p>
            Your content
        </p>
        <template #footer>
            <MazBtn @click="isOpen = false">
                Confirm
            </MazBtn>
        </template>
    </MazDialog>
</template>
  
<script setup>
import { ref } from 'vue'
import MazDialog from 'maz-ui/components/MazDialog'

const isOpen = ref(false)
</script>