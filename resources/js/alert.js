document.addEventListener("DOMContentLoaded", function () {
    var announcementWrapper = document.getElementById("announcement-wrapper");
    var closeButton = document.getElementById("close-announcement");

    // Check if the cookie is set
    if (
        !document.cookie
            .split("; ")
            .find((row) => row.startsWith("announcement_closed="))
    ) {
        // If not, show the announcement
        announcementWrapper.style.display = "flex";
    }

    // When the close button is clicked, set a cookie to remember that the user has closed the announcement
    closeButton.addEventListener("click", function () {
        var date = new Date();
        date.setFullYear(date.getFullYear() + 1); // The cookie will expire in 1 year
        document.cookie =
            "announcement_closed=true; expires=" +
            date.toUTCString() +
            "; path=/";
        announcementWrapper.style.display = "none";
    });
});