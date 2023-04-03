<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    eventCategories: {},
    event: {},
    passes: {}
})

const eventForm = useForm({
    title: props.event.title,
    start_date: props.event.start_date,
    end_date: props.event.end_date,
    time: props.event.time,
    place: props.event.place,
    description: props.event.description,
    event_category_id: props.event.event_category_id,
    picture: null
})

const submitEvent = () => {
    eventForm.put(route('event.update', props.event), {
        _method: 'put'
    })
}

const passForm = useForm({
    type: '',
    price: '',
    available_quantity: '',
    event_id: props.event?.id,
})

const submitPass = () => {
    passForm.post(route('pass.store'))
};
</script>

<template>
    <Head :title="`Modifier ${event.title}`" />
    <GuestLayout>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <h2 class="text-xl font-medium">{{ `Modifier ${event.title}` }}</h2>
            <fieldset class="grid grid-cols-4 gap-6 p-3 rounded-md">
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
                        <div class="text-sm text-red-600" v-if="eventForm.errors.event_category_id">
                            {{ eventForm.errors.event_category_id }}
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
                            placeholder="Photo" accept="image/*"
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
                            Modifier
                        </MazBtn>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">

            <div class="overflow-x-auto rounded">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-300">
                        <tr class="text-left">
                            <th class="p-3">Type</th>
                            <th class="p-3">Prix</th>
                            <th class="p-3">Quantite disponible</th>
                            <th class="p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="passe in passes"
                            class="border-b border-opacity-20 border-slatebg-slate-100 bg-slate-200">
                            <td class="p-3">
                                <p>{{ passe?.type }}</p>
                            </td>
                            <td class="p-3">
                                <p>{{ passe?.price }}</p>
                            </td>
                            <td class="p-3">
                                <p>{{ passe?.available_quantity }}</p>
                            </td>
                            <td class="flex flex-col md:flex-row justify-around p-2 space-y-1 md:space-x-1 items-center">
                                <span
                                    @click="modal.toggleModal(true, 'Supprimer', null, `Voulez-vous supprimer l\'evenement ${passe?.title} ?`)"
                                    class="p-2 rounded duration-300 hover:bg-slate-400">
                                    <i class="fi-sr-trash text-sm text-red-500"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <h2 class="text-xl font-medium">Ajouter un passe</h2>
            <fieldset class="grid grid-cols-4 gap-6 p-3 rounded-md">
                <form @submit.prevent class="grid grid-cols-6 gap-4 col-span-full">
                    <div class="col-span-full sm:col-span-3">
                        <label for="type" class="text-sm">Type</label>
                        <input v-model="passForm.type" id="type" type="text" placeholder="Type"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="passForm.errors.type">
                            {{ passForm.errors.type }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="price" class="text-sm">Prix</label>
                        <input v-model="passForm.price" id="price" type="text" placeholder="Prix"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="passForm.errors.price">
                            {{ passForm.errors.price }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="available_quantity" class="text-sm">Quantite disponible</label>
                        <input v-model="passForm.available_quantity" id="available_quantity" type="number" min="1"
                            placeholder="Quantite disponible"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="passForm.errors.available_quantity">
                            {{ passForm.errors.available_quantity }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <MazBtn @click="submitPass"
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded">Ajouter un
                            passe
                        </MazBtn>
                    </div>
                </form>
            </fieldset>
        </div>
    </GuestLayout>
</template>