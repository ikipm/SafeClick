function showWarningMessage(message) {
    const warningAlert = document.getElementById("warning-alert");
    warningAlert.innerHTML = message;
    warningAlert.style.display = "block";
}

function hideWarningMessage() {
    const warningAlert = document.getElementById("warning-alert");
    warningAlert.style.display = "none";
}

function convertMarkdownToHTML(markdown) {
    const regex = /\[exercise\]([\s\S]*?)\[\/exercise\]/g;
    return markdown.replace(regex, (match, content) => {
        content = content.replace(
            /\[ \]/g,
            '<input type="radio" name="exercise">'
        );
        content = content.replace(
            /\[x\]/g,
            '<input type="radio" name="exercise" id="correct">'
        );
        return content;
    });
}

function isMarkedDown() {
    return (
        document.querySelector(
            'input[name="exercise"][id="correct"]:checked'
        ) !== null
    );
}

document.addEventListener("DOMContentLoaded", function () {
    const parsedContentElement = document.getElementById("parsed-content");
    const parsedContent = parsedContentElement.dataset.content;

    const convertedHTML = convertMarkdownToHTML(parsedContent);
    const courseContent = document.querySelector(".course-content");
    courseContent.innerHTML = convertedHTML;

    const prevButton = document.querySelector(".button-prev");
    const nextButton = document.querySelector(".button-next");

    prevButton.addEventListener("click", function (e) {
        if (!isMarkedDown()) {
            e.preventDefault();
            showWarningMessage("This is not the correct answer.");
        } else {
            hideWarningMessage();
        }
    });

    nextButton.addEventListener("click", function (e) {
        if (!isMarkedDown()) {
            e.preventDefault();
            showWarningMessage("This is not the correct answer.");
        } else {
            hideWarningMessage();
        }
    });
});
