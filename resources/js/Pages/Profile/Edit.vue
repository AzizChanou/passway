<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    userCategories: {},
    user: {},
    passes: {},
});

const userForm = useForm({
    title: props.user.title,
    start_date: props.user.start_date,
    end_date: props.user.end_date,
    time: props.user.time,
    place: props.user.place,
    description: props.user.description,
    user_category_id: props.user.user_category_id,
    picture: null,
});

const submitEvent = () => {
    userForm.put(route("user.update", props.user), {
        _method: "put",
    });
};

const passForm = useForm({
    type: "",
    price: "",
    available_quantity: "",
    user_id: props.user?.id,
});

const submitPass = () => {
    passForm.post(route("pass.store"));
};
</script>

<template>
    <Head :title="`Modifier ${user.title}`" />
    <GuestLayout>
        <div class="w-full mx-auto rounded bg-slate-100 p-4 mt-4">
            <h2 class="text-xl font-medium">{{ `Modifier ${user.title}` }}</h2>
            <fieldset class="grid grid-cols-4 gap-6 p-3 rounded-md">
                <form
                    @submit.pruser
                    class="grid grid-cols-6 gap-4 col-span-full"
                >
                    <div class="col-span-full sm:col-span-3">
                        <label for="user_category_id" class="text-sm"
                            >Type d'evenement</label
                        >
                        <select
                            v-model="userForm.user_category_id"
                            id="user_category_id"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                        >
                            <option disabled selected value>
                                --Selectionner une categorie d'evenement--
                            </option>
                            <option
                                v-for="userCategory in userCategories"
                                :key="userCategory?.id"
                                :value="userCategory?.id"
                                required
                            >
                                {{ userCategory?.name }}
                            </option>
                        </select>
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.user_category_id"
                        >
                            {{ userForm.errors.user_category_id }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="title" class="text-sm">Titre</label>
                        <input
                            v-model="userForm.title"
                            id="title"
                            type="text"
                            placeholder="Titre"
                            min="1"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.title"
                        >
                            {{ userForm.errors.title }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="start_date" class="text-sm"
                            >Date debut</label
                        >
                        <input
                            v-model="userForm.start_date"
                            id="start_date"
                            type="date"
                            placeholder="Date debut"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.start_date"
                        >
                            {{ userForm.errors.start_date }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="end_date" class="text-sm">Date fin</label>
                        <input
                            v-model="userForm.end_date"
                            id="end_date"
                            type="date"
                            placeholder="Date fin"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.end_date"
                        >
                            {{ userForm.errors.end_date }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="time" class="text-sm">Heure</label>
                        <input
                            v-model="userForm.time"
                            id="time"
                            type="time"
                            placeholder="Heure"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.time"
                        >
                            {{ userForm.errors.time }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="place" class="text-sm">Lieu</label>
                        <input
                            v-model="userForm.place"
                            id="place"
                            type="text"
                            placeholder="Lieu"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.place"
                        >
                            {{ userForm.errors.place }}
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="description" class="text-sm"
                            >Description</label
                        >
                        <textarea
                            v-model="userForm.description"
                            id="description"
                            type="text"
                            placeholder="Description"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.description"
                        >
                            {{ userForm.errors.description }}
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="picture" class="text-sm">Photo</label>
                        <input
                            @input="userForm.picture = $user.target.files[0]"
                            id="picture"
                            type="file"
                            placeholder="Photo"
                            accept="image/*"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <progress
                            v-if="userForm.progress"
                            :value="userForm.progress.percentage"
                            max="100"
                        >
                            {{ userForm.progress.percentage }}%
                        </progress>
                        <div
                            class="text-sm text-red-600"
                            v-if="userForm.errors.picture"
                        >
                            {{ userForm.errors.picture }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <MazBtn
                            @click="submitEvent"
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded"
                        >
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
                        <tr
                            v-for="passe in passes"
                            class="border-b border-opacity-20 border-slatebg-slate-100 bg-slate-200"
                        >
                            <td class="p-3">
                                <p>{{ passe?.type }}</p>
                            </td>
                            <td class="p-3">
                                <p>{{ passe?.price }}</p>
                            </td>
                            <td class="p-3">
                                <p>{{ passe?.available_quantity }}</p>
                            </td>
                            <td
                                class="flex flex-col md:flex-row justify-around p-2 space-y-1 md:space-x-1 items-center"
                            >
                                <span
                                    @click="
                                        modal.toggleModal(
                                            true,
                                            'Supprimer',
                                            null,
                                            `Voulez-vous supprimer l\'evenement ${passe?.title} ?`
                                        )
                                    "
                                    class="p-2 rounded duration-300 hover:bg-slate-400"
                                >
                                    <i
                                        class="fi-sr-trash text-sm text-red-500"
                                    ></i>
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
                <form
                    @submit.pruser
                    class="grid grid-cols-6 gap-4 col-span-full"
                >
                    <div class="col-span-full sm:col-span-3">
                        <label for="type" class="text-sm">Type</label>
                        <input
                            v-model="passForm.type"
                            id="type"
                            type="text"
                            placeholder="Type"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="passForm.errors.type"
                        >
                            {{ passForm.errors.type }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="price" class="text-sm">Prix</label>
                        <input
                            v-model="passForm.price"
                            id="price"
                            type="text"
                            placeholder="Prix"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="passForm.errors.price"
                        >
                            {{ passForm.errors.price }}
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-3">
                        <label for="available_quantity" class="text-sm"
                            >Quantite disponible</label
                        >
                        <input
                            v-model="passForm.available_quantity"
                            id="available_quantity"
                            type="number"
                            min="1"
                            placeholder="Quantite disponible"
                            class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400"
                            required
                        />
                        <div
                            class="text-sm text-red-600"
                            v-if="passForm.errors.available_quantity"
                        >
                            {{ passForm.errors.available_quantity }}
                        </div>
                    </div>
                    <div class="col-span-full flex flex-row-reverse">
                        <MazBtn
                            @click="submitPass"
                            class="bg-primary text-white font-medium p-2 col-span-3 snap-end reverse rounded"
                            >Ajouter un passe
                        </MazBtn>
                    </div>
                </form>
            </fieldset>
        </div>
    </GuestLayout>
</template>
