<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import truncate from "@/helpers/truncate";
import { Head, Link } from "@inertiajs/vue3";
import { useModalStore } from "@/store/modal";
import { watch } from "vue";

const modal = useModalStore();

const props = defineProps({
    users: {},
});
</script>

<template>
    <Head title="Tableau de bord" />
    <AdminLayout>
        <div class="flex justify-between font-semibold my-6">
            <h2 class="mb-4 text-2xl font-semibold leading-tight">
                Utilisateur(s)
            </h2>
            <Link :href="route('profile.create')">
                <MazBtn> Creer un utilisateur </MazBtn>
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
                </colgroup>
                <thead class="bg-slate-100">
                    <tr class="text-left">
                        <th class="p-3">Nom</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                        <th class="p-3">Organisation</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        class="border-b border-opacity-20 border-slatebg-slate-100 bg-slate-300"
                    >
                        <td class="p-3">
                            <p>{{ user?.name }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ user?.email }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ user?.role }}</p>
                        </td>
                        <td class="p-3">
                            <p>{{ user?.organizer?.name }}</p>
                        </td>
                        <td
                            class="flex flex-col md:flex-row justify-around p-2 space-y-1 md:space-x-1 items-center"
                        >
                            <!--  <Link
                                :href="route('user.show', user.id)"
                                class="p-2 rounded duration-300 hover:bg-slate-400"
                            >
                                <i class="fi-sr-eye text-sm text-primary"></i
                            ></Link> -->
                            <Link
                                :href="route('profile.edit', user.id)"
                                as="button"
                                class="p-2 rounded duration-300 hover:bg-slate-400"
                                ><i
                                    class="fi-sr-edit text-sm text-secondary"
                                ></i
                            ></Link>
                            <Link
                                :href="route('profile.delete', user.id)"
                                as="button"
                                method="delete"
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
