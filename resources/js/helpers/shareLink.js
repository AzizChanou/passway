function shareLink(url, urlTitle) {
    if (navigator.share) {
        navigator.share({
            title: urlTitle,
            url: url,
        })
    }
};

export default shareLink;