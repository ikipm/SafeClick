document.addEventListener("DOMContentLoaded", function () {
    const snowContainer = document.getElementById("snow-container");

    for (let i = 0; i < 50; i++) {
        createSnowflake();
    }

    function createSnowflake() {
        const snowflake = document.createElement("div");
        snowflake.classList.add("snowflake");

        snowflake.style.width = Math.random() * 8 + "px";
        snowflake.style.height = snowflake.style.width;
        snowflake.style.left = Math.random() * window.innerWidth + "px";
        snowflake.style.animationDuration = Math.random() * 8 + 4 + "s";
        snowflake.style.animationDelay = Math.random() * 2 + "s";
        snowContainer.appendChild(snowflake);

        function resetSnowflake() {
            snowflake.style.left = Math.random() * window.innerWidth + "px";
            snowflake.style.animationDuration = Math.random() * 8 + 4 + "s";
            snowflake.style.animationDelay = Math.random() * 2 + "s";
        }

        snowflake.addEventListener("animationend", resetSnowflake);
    }
});