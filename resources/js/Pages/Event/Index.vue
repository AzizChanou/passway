<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    events: {}
})

</script>

<template>
    <Head title="Tableau de bord" />

    <AdminLayout>
        <div v-for="event in events" class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row mt-4">
            <img src="https://source.unsplash.com/640x480/?1" alt="" class="h-80 bg-slate-100 aspect-video">
            <div class="flex flex-col justify-center flex-1 p-6 bg-slate-100">
                <h3 class="text-3xl font-bold">{{ event?.title }}</h3>
                <span class="text-sm uppercase text-secondary">{{ `${event?.date} - ${event?.time}` }}</span>
                <span class="text-sm uppercase">{{ event?.place }}</span>
                <p class="my-6">
                    {{ event?.description }}
                </p>
                <div class="flex flex-wrap justify-between items-center">
                    <div class="flex space-x-2 text-sm">
                        <div title="Type de tickets" class="flex items-center p-1 space-x-1.5">
                            <i class="text-secondary fi-sr-ticket"></i>
                        </div>
                        <div title="Nombre de commentaires" class="flex items-center p-1 space-x-1.5">
                            <i class="text-secondary fi-sr-comments"></i>
                            <span>{{ event?.comments_count }}</span>
                        </div>
                        <button title="Partager cet evenement"
                            @click="shareLink(route('event.show', event?.id), event?.title)" aria-label="Share this post"
                            type="button" class="p-2">
                            <i class="text-secondary fi-sr-share"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>