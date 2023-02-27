<script setup>
import timeElapsed from '@/helpers/timeElapsed';
import shareLink from '@/helpers/shareLink';
import truncate from '@/helpers/truncate';
import { Link } from '@inertiajs/vue3';

defineProps({
    event: Object
})

</script>

<template>
    <div class="flex flex-col min-w-full max-w-sm p-4 overflow-hidden bg-slate-100 rounded-lg shadow">
        <div class="flex justify-between">
            <div class="flex space-x-4">
                <img alt="" src="https://source.unsplash.com/100x100/?portrait"
                    class="object-cover w-10 h-10 rounded-full shadow">
                <div class="flex flex-col space-y-1">
                    <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">{{ event?.organizer?.name }}</a>
                    <span class="text-xs text-secondary">{{ timeElapsed(event?.date) }}</span>
                </div>
            </div>
            <div class="text-sm">
                <p class="text-secondary">{{ event?.place }}</p>
            </div>
        </div>
        <div class="mt-4">
            <img src="https://source.unsplash.com/random/100x100/?5" alt="" class="object-cover w-full mb-4 h-40 sm:h-60">
            <h2 class="mb-1 text-xl font-medium">{{ event?.title }}</h2>
            <p class="text-sm">{{ truncate(event?.description, 100) }}
                <Link class="text-secondary hover:text-primary" :href="route('event.show', event?.id)">
                voir plus...
                </Link>
            </p>
        </div>
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex space-x-2">
                <span class="text-secondary text-sm font-mono">{{ event?.date }}</span>
            </div>
            <div class="flex space-x-2 text-sm">
                <div title="Type de tickets" class="flex items-center p-1 space-x-1.5">
                    <i class="text-secondary fi-sr-ticket"></i>
                    <span>{{ event?.passes.reduce((acc, passe) => acc + passe.available_quantity, 0) }}</span>
                </div>
                <div title="Nombre de commentaires" class="flex items-center p-1 space-x-1.5">
                    <i class="text-secondary fi-sr-comments"></i>
                    <span>{{ event?.comments_count }}</span>
                </div>
                <button title="Partager cet evenement" @click="shareLink(route('event.show', event?.id), event?.title)"
                    aria-label="Share this post" type="button" class="p-2">
                    <i class="text-secondary fi-sr-share"></i>
                </button>
            </div>
        </div>
    </div>
</template>