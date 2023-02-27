<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import generateRandomHexColor from '@/helpers/generateRandomHexColor';
import shareLink from '@/helpers/shareLink';

const props = defineProps({
    event: {},
})

console.log(props.event);

</script>

<template>
    <Head :title="event?.title" />
    <GuestLayout>
        <div class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row mt-4">
            <img src="https://source.unsplash.com/640x480/?1" alt="" class="h-80 bg-slate-100 aspect-video">
            <div class="flex flex-col justify-center flex-1 p-6 bg-slate-100">
                <span class="text-sm uppercase">{{ event?.organizer?.name }}</span>
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
                            <span>{{ event?.passes.reduce((acc, passe) => acc + passe.available_quantity, 0) }}</span>
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
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Profile</p>
                    <p class="text-xs">Adipisci fuga autem eum!</p>
                </div>
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="website" class="text-sm">Type de tickets</label>
                        <select id="website"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400">
                            <option selected>--Selectionner type de tickets--</option>
                            <option v-for="passe in event?.passes" :key="passe?.id" :value="passe?.type">
                                {{ `${passe?.type} - ${passe?.price} CFA` }}
                            </option>
                        </select>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="username" class="text-sm">Quantite</label>
                        <input id="username" type="number" placeholder="Quantite"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400">
                    </div>
                    <div class="col-span-full">
                        <label for="email" class="text-sm">Email</label>
                        <input id="email" type="email" placeholder="Email"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" />
                    </div>
                    <div class="col-span-full">
                        <label for="number" class="text-sm">Numero</label>
                        <input id="number" type="text" placeholder="Numero"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" />
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <button
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded">Acheter</button>
                    </div>
                    <input type="text" class="hidden" name="pass_id">
                    <input type="text" class="hidden" name="event_id">
                </div>
            </fieldset>
        </div>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <div>
                <h3 class="text-2xl font-medium">Commentaires</h3>
                <div v-for="comment in event?.comments" :key="comment?.id"
                    class="bg-slate-200 rounded-lg shadow-sm w-full min-w-full p-4 mt-4">
                    <div class="flex items-center mb-2">
                        <span alt="Avatar"
                            :style="'background-color : ' + generateRandomHexColor(comment?.email.substr(0, 2))"
                            class="w-8 h-8 rounded-full mr-2 uppercase text-white font-medium text-center p-1">{{
                                comment?.email.substr(0, 2)
                            }}</span>
                        <div class="text-gray-700 font-medium">{{ comment?.email }}</div>
                    </div>
                    <div class="text-gray-800">{{ comment?.text }}</div>
                </div>
            </div>
            <fieldset class="w-full gap-6 rounded-md shadow-sm bg-slate-100 mt-4">
                <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full">
                        <label for="username" class="text-sm">Username</label>
                        <input id="username" type="text" placeholder="Username"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400">
                    </div>
                    <div class="col-span-full">
                        <label for="bio" class="text-sm">Bio</label>
                        <textarea id="bio" placeholder=""
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"></textarea>
                    </div>
                    <button class="col-span-full bg-primary text-white rounded p-2">Commenter</button>
                </div>
            </fieldset>
        </div>
    </GuestLayout>
</template>