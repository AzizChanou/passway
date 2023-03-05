<script setup>
import MazDialog from 'maz-ui/components/MazDialog'
import { useModalStore } from '@/store/modal'

const modal = useModalStore()
</script>

<template>
    <MazDialog v-model="modal.isOpen" :title="modal.title">
        <div v-if="modal.message" class="">{{ modal.message }}</div>
        <Component v-else :is="modal.component" />
        <template v-if="modal.message" #footer>
            <MazBtn @click="modal.isOpen = true, modal.confirmation = true">
                Confirmer
            </MazBtn>
        </template>
    </MazDialog>
</template>