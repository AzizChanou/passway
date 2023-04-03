<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import generateRandomHexColor from '@/helpers/generateRandomHexColor';
import shareLink from '@/helpers/shareLink';
import { onMounted, onUnmounted } from 'vue';
import {
    openKkiapayWidget,
    addKkiapayListener,
    removeKkiapayListener,
} from "kkiapay";
import { useModalStore } from '@/store/modal';

const modal = useModalStore();
const props = defineProps({
    event: {},
})

const ticketsForm = useForm({
    name: 'Kyogre',
    phone: '69457894',
    email: 'azobo@yopmail.fr',
    address: 'St. Rita',
    quantity: 1,
    pass_id: null
})

const commentForm = useForm({
    email: '',
    text: '',
    event_id: props.event?.id,
});

const pay = () => {
    if (navigator.onLine) {
        openKkiapayWidget({
            callback: "",
            data: "",
            amount: 0,
            api_key: "40c5cb501c9611ed995cd39f617b9df2",
            paymentmethod: "momo",
            theme: "#0f213a",
            sandbox: true,
            address: ticketsForm.address,
            email: ticketsForm.email,
            phone: ticketsForm.phone,
        });
    } else {
        modal.toggleModal(true, 'Connexion', null, "Veuillez vous connecter à internet et ressayer !")
    }
};

const successHandler = (response) => {
    console.log(response);
    /*  form.transactionid = response.transactionId;
     form.account = response.account;
     if (response.transactionId) {
         submit();
     } */
};

const submitOrder = () => {
    console.log(ticketsForm);
}

const submitComment = () => {
    commentForm.post(route('comment.store', {
        onFinish: () => commentForm.reset
    }));
};

onMounted(() => {
    addKkiapayListener("success", successHandler);
});

onUnmounted(() => {
    removeKkiapayListener("success", successHandler);
});
</script>

<template>
    <Head :title="event?.title" />
    <GuestLayout>
        <div class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row mt-4">
            <img :src="event?.picture_path" alt="" class="h-80 bg-slate-100 aspect-video">
            <div class="flex flex-col justify-center flex-1 p-6 bg-slate-100">
                <span class="text-sm uppercase">{{ event?.organizer?.name }}</span>
                <h3 class="text-3xl font-bold">{{ event?.title }}</h3>
                <span class="text-sm uppercase text-secondary">{{ `${event?.start_date} - ${event?.time}` }}</span>
                <span class="text-sm uppercase">{{ event?.place }}</span>
                <p class="my-6">
                    {{ event?.description }}
                </p>
                <div class="flex flex-wrap justify-between items-center">
                    <div class="flex space-x-2 text-sm">
                        <div title="Type de pass" class="flex items-center p-1 space-x-1.5">
                            <i class="text-secondary fi-sr-ticket"></i>
                            <span>{{ event?.passes?.reduce((acc, passe) => acc + passe.available_quantity, 0) }}</span>
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
                <form @submit.prevent class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full sm:col-span-3">
                        <label for="website" class="text-sm">Type de pass</label>
                        <select v-model="ticketsForm.pass_id" id="website"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400">
                            <option disabled selected value>--Selectionner type de pass--</option>
                            <option v-for="passe in event?.passes" :key="passe?.id" :value="passe?.id" required>
                                {{ `${passe?.type} - ${passe?.price} CFA` }}
                            </option>
                        </select>
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.pass_id">
                            {{ ticketsForm.errors.pass_id }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="quantity" class="text-sm">Quantite</label>
                        <input v-model="ticketsForm.quantity" id="quantity" type="number" placeholder="Quantite" min="1"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.quantity">
                            {{ ticketsForm.errors.quantity }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="name" class="text-sm">Nom</label>
                        <input v-model="ticketsForm.name" id="name" type="text" placeholder="Nom"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.name">
                            {{ ticketsForm.errors.name }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="address" class="text-sm">Adresse</label>
                        <input v-model="ticketsForm.address" id="address" type="text" placeholder="Adresse"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.address">
                            {{ ticketsForm.errors.address }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="email" class="text-sm">Email</label>
                        <input v-model="ticketsForm.email" id="email" type="email" placeholder="Email"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.email">
                            {{ ticketsForm.errors.email }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="phone" class="text-sm">Numero</label>
                        <input v-model="ticketsForm.phone" id="phone" type="text" placeholder="Numero"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required />
                        <div class="text-sm text-red-600" v-if="ticketsForm.errors.phone">
                            {{ ticketsForm.errors.phone }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <MazBtn @click="pay" :disabled="ticketsForm.quantity <= 0 && ticketsForm.quantity === null"
                            :class="{ 'opacity-50': ticketsForm.quantity <= 0 && ticketsForm.quantity === null }"
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded">
                            Acheter
                        </MazBtn>
                    </div>
                </form>
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
            <div class="w-full gap-6 rounded-md shadow-sm bg-slate-100 mt-4">
                <form @submit.prevent="submitComment" class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                    <div class="col-span-full">
                        <label for="email" class="text-sm">Email</label>
                        <input v-model="commentForm.email" id="email" type="email" placeholder="Email"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400" required>
                        <div class="text-sm text-red-600" v-if="commentForm.errors.email">
                            {{ commentForm.errors.email }}
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="comment" class="text-sm">Commentaire</label>
                        <textarea v-model="commentForm.text" id="comment" placeholder="Votre commentaire..."
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required></textarea>
                        <div class="text-sm text-red-600" v-if="commentForm.errors.text">
                            {{ commentForm.errors.text }}
                        </div>
                    </div>
                    <button class="col-span-full bg-primary text-white rounded p-2">Commenter</button>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>