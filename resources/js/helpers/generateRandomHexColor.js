function generateRandomHexColor(string) {
    let hash = 0;
    for (let i = 0; i < string.length; i++) {
        hash = string.charCodeAt(i) + ((hash << 5) - hash);
    }
    let color = '#';
    for (let j = 0; j < 3; j++) {
        let value = (hash >> (j * 8)) & 0xff;
        color += ('00' + value.toString(16)).substr(-2);
    }
    return color;
}

export default generateRandomHexColor;