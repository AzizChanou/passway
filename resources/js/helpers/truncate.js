/**
 * Permet de reduire un texte a un nombre de caractere definis
 * @param {*} string Text a reduire
 * @param {*} limit  Nombre de caractere a afficher
 * @returns 
 */
function truncate(string, limit) {
    if (string?.length > limit) {
        return string.slice(0, limit);
    } else {
        return string;
    }
};

export default truncate;