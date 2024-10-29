import DragDropTouch from "drag-drop-touch";

const warningAlert = document.getElementById("warning-alert");
const parsedContentElement = document.getElementById("parsed-content");
const parsedContent = JSON.parse(parsedContentElement.getAttribute("data-content"));
const courseContent = document.querySelector(".course-content");
const nextButton = document.querySelector(".button-next");

document.addEventListener("DOMContentLoaded", function () {
    const convertedHTML = convertMarkdownToHTML(parsedContent);
    courseContent.innerHTML = convertedHTML;
    if (parsedContent.includes("[drag]")) {
        initDragAndDrop();
    }
    if (nextButton) {
        nextButton.addEventListener("click", handleNextButtonClick);
    }
});

function showWarningMessage(message) {
    warningAlert.innerHTML = message;
    warningAlert.style.display = "block";
}

function hideWarningMessage() {
    warningAlert.style.display = "none";
}

function convertMarkdownToHTML(markdown) {
    const exerciseRegex = /\[exercise\]([\s\S]*?)\[\/exercise\]/g;
    markdown = markdown.replace(exerciseRegex, (match, content) => {
        content = content.replace(/\[ \]/g, () => {
            var num = Math.random(1, 20);
            return '<input type="radio" name="exercise" id="' + "f".charCodeAt() + num + ' ' + num + '">';
        });
        content = content.replace(/\[x\]/g, () => {
            var num = Math.random(1, 20);
            return '<input type="radio" name="exercise" id="' + "c".charCodeAt() + num + ' ' + num + '">';
        });
        return content;
    });

    const dragRegex = /\[drag\]([\s\S]*?)\[\/drag\]/g;
    return markdown.replace(dragRegex, (match, content) => {
        const lines = content.trim().split("\n");
        const dragItems = [];
        const dragZones = [];
        lines.forEach((line) => {
            if (line.startsWith("[")) {
                dragZones.push(line);
            } else {
                dragItems.push(line);
            }
        });

        const dragItemsHTML = dragItems.map((item, index) => {
            const matchResult = item.match(/^(.*?)\s*\((\d+)\)$/);
            if (matchResult) {
                const itemName = matchResult[1].trim();
                const dragZoneNumber = matchResult[2];
                return `<div class="draggable-item" draggable="true" data-index="${index}" data-dragzone="${dragZoneNumber}">${itemName}</div>`;
            }
            return "";
        });

        const dragZoneContainers = dragZones.map((zone, index) => {
            const matchResult = zone.match(/^\[(.*?)\]\s*\((\d+)\)$/);
            if (matchResult) {
                const zoneName = matchResult[1].trim();
                const zoneNumber = matchResult[2];
                return `<div class="drag-zone" data-dragzone="${zoneNumber}">${zoneName}</div>`;
            }
            return "";
        });
        return `<div class="draggable-container">${dragItemsHTML.join("")}</div><div class="drag-zone-container">${dragZoneContainers.join("")}</div>`;
    });
}

function isMarkedDown() {
    const checkedInput = document.querySelector('input[name="exercise"]:checked');
    const inputId = checkedInput.id.split(' ');
    if (checkedInput !== null && inputId[0] === "c".charCodeAt() + inputId[1]) {
        return true;
    }
    return false;
}

function areItemsInCorrectZones() {
    const draggableItems = document.querySelectorAll(".draggable-item");
    let allCorrect = true;
    draggableItems.forEach((item) => {
        const parentZone = item.parentElement;
        if (!parentZone.dataset.dragzone || item.dataset.dragzone !== parentZone.dataset.dragzone) {
            item.classList.add("incorrect");
            item.classList.remove("correct");
            allCorrect = false;
        } else {
            item.classList.add("correct");
            item.classList.remove("incorrect");
        }
    });
    return allCorrect;
}

function initDragAndDrop() {
    const draggableItems = document.querySelectorAll(".draggable-item");
    const dragZones = document.querySelectorAll(".drag-zone");
    draggableItems.forEach((item) => {
        item.addEventListener("dragstart", handleDragStart);
    });
    dragZones.forEach((zone) => {
        zone.addEventListener("dragover", handleDragOver);
        zone.addEventListener("drop", handleDrop);
    });
}

function handleDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.dataset.index);
}

function handleDragOver(event) {
    event.preventDefault();
    const dragZone = event.target.dataset.dragzone;
    if (dragZone) {
        event.dataTransfer.dropEffect = "move";
    }
}

function handleDrop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text/plain");
    const draggedItem = document.querySelector(`.draggable-item[data-index="${data}"]`);
    const dragZone = event.target.closest(".drag-zone");
    if (dragZone) {
        dragZone.appendChild(draggedItem);
    }
}

function handleNextButtonClick(e) {
    if (isLastVisitedContent) {
        Lang.setLocale(currentLocale);
        if (parsedContent.includes("[exercise]") && !isMarkedDown()) {
            e.preventDefault();
            showWarningMessage(Lang.get("courses.notCorrectAnswer"));
        } else if (parsedContent.includes("[drag]") && !areItemsInCorrectZones()) {
            e.preventDefault();
            showWarningMessage(Lang.get("courses.notCorrectAnswer"));
        } else {
            hideWarningMessage();
        }
    }
}
