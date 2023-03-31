<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DropZone from '@/Components/DropZone.vue';

defineProps({
    eventCategories: {}
})

const eventForm = useForm({
    title: '',
    start_date: '',
    end_date: '',
    time: '',
    place: '',
    description: '',
    event_category_id: null,
    picture: null
})
const submitEvent = () => {
    eventForm.post(route('event.store'), {
        _method: 'put'
    })
    console.log(eventForm);
}
</script>

<template>
    <Head title="Creer un evenement" />
    <GuestLayout>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md">
                <h2 class="text-xl font-medium">Creer un evenement</h2>
                <form @submit.prevent class="grid grid-cols-6 gap-4 col-span-full">
                    <div class="col-span-full sm:col-span-3">
                        <label for="event_category_id" class="text-sm">Type d'evenement</label>
                        <select v-model="eventForm.event_category_id" id="event_category_id"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400">
                            <option disabled selected value>--Selectionner une categorie d'evenement--</option>
                            <option v-for="eventCategory in eventCategories" :key="eventCategory?.id"
                                :value="eventCategory?.id" required>
                                {{ eventCategory?.name }}
                            </option>
                        </select>
                        <div class="text-sm text-red-600" v-if="eventForm.errors.pass_id">
                            {{ eventForm.errors.pass_id }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="title" class="text-sm">Titre</label>
                        <input v-model="eventForm.title" id="title" type="text" placeholder="Titre" min="1"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.title">
                            {{ eventForm.errors.title }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="start_date" class="text-sm">Date debut</label>
                        <input v-model="eventForm.start_date" id="start_date" type="date" placeholder="Date debut"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.start_date">
                            {{ eventForm.errors.start_date }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="end_date" class="text-sm">Date fin</label>
                        <input v-model="eventForm.end_date" id="end_date" type="date" placeholder="Date fin"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.end_date">
                            {{ eventForm.errors.end_date }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="time" class="text-sm">Heure</label>
                        <input v-model="eventForm.time" id="time" type="time" placeholder="Heure"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.time">
                            {{ eventForm.errors.time }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="place" class="text-sm">Lieu</label>
                        <input v-model="eventForm.place" id="place" type="text" placeholder="Lieu"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.place">
                            {{ eventForm.errors.place }}
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="description" class="text-sm">Description</label>
                        <textarea v-model="eventForm.description" id="description" type="text" placeholder="Description"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="eventForm.errors.description">
                            {{ eventForm.errors.description }}
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="picture" class="text-sm">Photo</label>
                        <input @input="eventForm.picture = $event.target.files[0]" id="picture" type="file"
                            placeholder="Photo"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <progress v-if="eventForm.progress" :value="eventForm.progress.percentage" max="100">
                            {{ eventForm.progress.percentage }}%
                        </progress>
                        <div class="text-sm text-red-600" v-if="eventForm.errors.picture">
                            {{ eventForm.errors.picture }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <MazBtn @click="submitEvent"
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded">
                            Creer un evenement
                        </MazBtn>
                    </div>
                </form>
            </fieldset>
        </div>
    </GuestLayout>
</template>