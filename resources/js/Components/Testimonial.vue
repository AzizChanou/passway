<script setup>
defineProps({
  testimonial: Object,
})

</script>

<template>
  <div class="container flex flex-col items-center p-4 mx-auto space-y-6 md:p-8">
    <p
      class="px-6 py-2 text-2xl font-semibold text-center sm:font-bold sm:text-3xl md:text-4xl lg:max-w-2xl xl:max-w-4xl text-primary">
      "{{ testimonial?.text }}"</p>
    <div class="flex justify-center space-x-3">
      <img src="https://source.unsplash.com/80x80/?portrait?1" alt="" class="w-20 h-20 bg-center bg-cover rounded-md">
      <div>
        <p class="leading-tight">{{ testimonial?.fullname }}</p>
        <p class="text-sm leading-tight text-gray-300">Founder, {{ testimonial?.company }}</p>
      </div>
    </div>
  </div>
</template>
