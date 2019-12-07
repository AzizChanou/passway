<script setup>
import MazDialog from 'maz-ui/components/MazDialog'
import { useModalStore } from '@/store/modal'

const modal = useModalStore()

const confirm = () => {
    modal.isOpen = true
    modal.confirmation = true
    console.log(modal);
}
</script>

<template>
    <MazDialog v-model="modal.isOpen" :title="modal.title">
        <div v-if="modal.message" class="">{{ modal.message }}</div>
        <Component v-else :is="modal.component" />
        <template v-if="modal.message" #footer>
            <MazBtn @click="confirm">
                Confirmer
            </MazBtn>
        </template>
    </MazDialog>
</template>