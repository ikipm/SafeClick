document.addEventListener("DOMContentLoaded", function () {
    const openModalButtons = document.querySelectorAll(".contentInfo-button");
    const closeModalButton = document.getElementById("closeModalButton");

    const openModal = (courseId, contentTitle, content) => {
        const modalContent = document.getElementById("courseInfoContent");
        modalContent.innerHTML = `
            <h2>Course ID: ${courseId}</h2>
            <h3>Content Title: ${contentTitle}</h3>
            <p>${content}</p>
        `;
        document.getElementById("courseInfoModal").style.display = "block";
    };

    const closeModal = () => {
        document.getElementById("courseInfoModal").style.display = "none";
    };

    if (openModalButtons) {
        openModalButtons.forEach((button) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                const { courseId, contentTitle, content } = button.dataset;
                openModal(courseId, contentTitle, content);
            });
        });
    }

    if (closeModalButton) {
        closeModalButton.addEventListener("click", (event) => {
            event.preventDefault();
            closeModal();
        });
    }
});
