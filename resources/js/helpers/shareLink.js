function shareLink(url, urlTitle) {
    if (navigator.share) {
        navigator.share({
            title: urlTitle,
            url: url,
        }).then(() => console.log('Shared'))
            .catch((error) => console.log('Not Shared'))
    } else {
        console.log('non supporter');
    }
};

export default shareLink;