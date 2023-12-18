const sidebarToggle = document.querySelector(".sidebar-toggle");
const sidebar = document.querySelector(".sidebar");
const container = document.querySelector('.container');


var toggle = false;

sidebarToggle.addEventListener("click", () => {
    if (toggle) {
        sidebar.style.display = "none";
        container.classList.remove('blur');
    } else {
        container.classList.toggle('blur');
        sidebar.style.display = "block";
    }
    toggle = !toggle;
});
