/**
 * 
 * @param {*} string 
 * @param {*} limit 
 * @returns 
 */
function truncate(string, limit) {
    if (string.length > limit) {
        return string.slice(0, limit);
    } else {
        return string;
    }
};

export default truncate;