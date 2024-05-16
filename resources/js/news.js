window.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggle-news");
    const newsContainer = document.getElementById("newsContainer");
    const verticalNews = document.getElementById("vertical-news-text");
    let isHidden = false;

    const toggleNews = () => {
        newsContainer.classList.toggle('hidden');
        newsSection.style.cssText = isHidden ? "overflow-y: auto; width: 300px" : "overflow-y: hidden; width: 1%";
        verticalNews.style.cssText = isHidden ? "opacity: 0" : "opacity: 1"; /* Change opacity instead of display */
        isHidden = !isHidden;
    };

    toggleButton.addEventListener("click", toggleNews);
    toggleNews();
});
