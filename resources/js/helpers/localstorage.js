export default new class Storage {
    constructor() {
        this.storage = localStorage;
    }

    #save(storeId, storeData) {
        this.storage.setItem(storeId, JSON.stringify(storeData));
    }

    /**
     * Permet de supprimer une donnee dans le stockage local du navigateur.
     * @param {String} storeId Id de la donnee a supprimer.
     */
    clearStore(storeId) {
        this.storage.removeItem(storeId);
    }

    /**
     * Permet de recuperer  une donnee dans le stockage local du navigateur.
     * @param {String} storeId Id de la donnee a recuperer.
     * @returns {String} La donnee en format JSON.
     */
    fetchAll(storeId) {
        const serializedStore = this.storage.getItem(storeId);
        return JSON.parse(serializedStore);
    }

    /**
     * Permet d'enregistrer une donnee dans le stockage local du navigateur.
     * @param {String} storeId Id de la donnee a enregistrer ou a mettre a jour.
     * @param {String} storeData Donnee a enregistrer ou a mettre a jour.
     */
    performUpdate(storeId, storeData) {
        this.#save(storeId, storeData);
    }
}
