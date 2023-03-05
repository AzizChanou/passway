import { defineStore } from "pinia";
import { shallowRef } from 'vue'

export const useModalStore = defineStore("modal", {
    state: () => ({
        confirmation: Boolean,
        /**
         * Permet d'ouvrir le modal'.
         */
        title: ' ',
        /**
         * Permet d'ouvrir le modal'.
         */
        isOpen: false,
        /**
         * Permet de recuperer le composant a afficher dans le modal.
         */
        component: shallowRef(),
        /**
         * Permet de recuperer le message a afficher dans le modal.
         */
        message: null,
    }),
    getters: {
        /**
         * Permet de recuperer la decision de l'utilisateur.
         * @returns {String}
         */
        getConfirmation() {
            return this.confirmation;
        },
    },
    actions: {
        /**
         * Permet d'afficher une fenetre modal en passant l'isOpen, le title, le composant et le message du modal.
         * Elle doit etre utilise avec un label qui doit recuperer l'isOpen passee en parametre :for="modal.isOpen"
         * @param {String} isOpen 
         * @param {Object} component 
         * @param {String} message 
         */
        toggleModal(isOpen, title = null, component = null, message = null) {
            this.isOpen = isOpen;
            this.title = title;
            this.component = component;
            this.message = message;
        },
        /**
         * Permet de confirmer ou non une action du modal.
         * @param {Boolean} confirmation 
         */
        confirm(confirmation) {
            this.confirmation = confirmation;
        }
    },
})