<script setup>
import { useToast } from 'maz-ui'

const { toast } = useToast()

function showInfo() {
    toast.info('Info message', {
        position: 'top',
    })
}

function showError() {
    toast.error('Error message', {
        position: 'bottom',
        timeout: 1000,
    })
}

function showWarning() {
    toast.warning('Warning message', {
        position: 'top-right'
    })
}

function showSuccess() {
    toast.success('Success message', {
        position: 'bottom-left',
        persistent: true,
    })
}
</script>


<template>
    <MazBtn color="info" @click="showInfo">
        Show persistent info toast on top
    </MazBtn>

    <MazBtn color="danger" @click="showError">
        Show error toast on bottom with 1s timeout
    </MazBtn>

    <MazBtn color="warning" @click="showWarning">
        Show warning toast on top right
    </MazBtn>

    <MazBtn color="success" @click="showSuccess">
        Show persistent success toast on bottom left
    </MazBtn>
</template>