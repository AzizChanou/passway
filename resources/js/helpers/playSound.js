const playSound = (link) => {
    var audio = new Audio(link);
    audio.play();
};

export default playSound;