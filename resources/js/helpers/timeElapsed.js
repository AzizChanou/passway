/**
 * Prends en parametre un timestamp et renvoie le nombre de temps ecouler ou avenir.
 * @param {*} timestamp 
 * @returns 
 */

function timeElapsed(timestamp) {
    // Récupération de la date courante
    const maintenant = new Date().getTime();
    timestamp = new Date(timestamp);

    const difference = timestamp - maintenant < 0 ? maintenant - timestamp : timestamp - maintenant;

    const heures = difference / (1000 * 60 * 60);
    const jours = heures / 24;
    const mois = jours / 30;
    const annees = mois / 12;

    if (timestamp < maintenant) {
        if (annees >= 1) {
            return `Il y a ${Math.round(annees)} an(s)`;
        } else if (mois >= 1) {
            return `Il y a ${Math.round(mois)} mois`
        } else if (jours >= 1) {
            return `Il y a ${Math.round(jours)} jour(s)`;
        } else {
            return `Il y a ${Math.round(heures)} heure(s)`;
        }
    } else {
        if (annees >= 1) {
            return `Dans ${Math.round(annees)} an(s)`;
        } else if (mois >= 1) {
            return `Dans ${Math.round(mois)} mois`;
        } else if (jours >= 1) {
            return `Dans ${Math.round(jours)} jour(s)`;
        } else {
            return `Dans ${Math.round(heures)} heure(s)`;
        }
    }
};

export default timeElapsed;