<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import truncate from "@/helpers/truncate";
import { Head, Link } from "@inertiajs/vue3";
import { useModalStore } from "@/store/modal";
import { watch } from "vue";

const modal = useModalStore();

defineProps({
    organizer: {},
    events: {},
});
</script>

<template>
    <Head title="Tableau de bord" />
    <AdminLayout>
        <div class="flex justify-between font-semibold my-6">
            <h2 class="mb-4 text-2xl font-semibold leading-tight">
                Evenements
            </h2>
            <Link :href="route('event.create')">
                <MazBtn> Creer un evenement </MazBtn>
            </Link>
        </div>
        <div class="overflow-x-auto rounded">
            <table class="min-w-full text-xs">
                <colgroup>
                    <col />
                    <col />
                    <col />
                    <col />
                    <col />
                    <col class="w-24" />
                </colgroup>
                <thead class="bg-slate-100">
                    <tr class="text-left">
                        <th class="p-3">Nom Evenement</th>
                        <th class="p-3">Lieu</th>
                        <th class="p-3">Date/Heure</th>
                        <th class="p-3">Description</th>
                        <th class="p-3 text-left">Passe(s) & Ticket(s)</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="event in events"
                        class="border-b border-opacity-20 border-slatebg-slate-100 bg-slate-300"
                    >
                        <td class="p-3">
                            <p>{{ event?.title }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ event?.place }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ event?.start_date }}</p>
                            <p class="text-gray-400">{{ event?.time }}</p>
                        </td>
                        <td class="p-3">
                            {{ truncate(event?.description, 100) }}...
                        </td>
                        <td class="p-3 text-left">
                            <p>Passe : {{ event?.passes_count }}</p>
                            <p class="text-gray-400">
                                Ticket :
                                {{
                                    event?.passes.reduce(
                                        (acc, passe) =>
                                            acc + passe.available_quantity,
                                        0
                                    )
                                }}
                            </p>
                        </td>
                        <td
                            class="flex flex-col md:flex-row justify-around p-2 space-y-1 md:space-x-1 items-center"
                        >
                            <Link
                                :href="route('event.show', event.id)"
                                class="p-2 rounded duration-300 hover:bg-slate-400"
                            >
                                <i class="fi-sr-eye text-sm text-primary"></i
                            ></Link>
                            <Link
                                :href="route('event.edit', event.id)"
                                as="button"
                                class="p-2 rounded duration-300 hover:bg-slate-400"
                                ><i
                                    class="fi-sr-edit text-sm text-secondary"
                                ></i
                            ></Link>
                            <Link
                                :href="route('event.destroy', event.id)"
                                as="button"
                                class="p-2 rounded duration-300 hover:bg-slate-400"
                            >
                                <i class="fi-sr-trash text-sm text-red-500"></i
                            ></Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
