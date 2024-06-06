document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggleAbout");
    const newsContent = document.querySelector(".news-content");

    toggleButton.addEventListener("click", function() {
        newsContent.classList.toggle("show-details");
        if (newsContent.classList.contains("show-details")) {
            toggleButton.textContent = "Hide Details";
        } else {
            toggleButton.textContent = "Show Details";
        }
    });
});
