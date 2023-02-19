<script setup>
import MazBadge from 'maz-ui/components/MazBadge'

const colors = [
    'primary',
    'secondary',
    'info',
    'success',
    'warning',
    'danger',
    'white',
    'black',
    'gray',
]
</script>
  
<template>
    <MazBadge v-for="color in color" :key="color" :color="color">
        {{ color }}
    </MazBadge>
</template>