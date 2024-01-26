import dragDropTouch from 'drag-drop-touch';

const warningAlert = document.getElementById("warning-alert");
const parsedContentElement = document.getElementById("parsed-content");
const parsedContentJSON = parsedContentElement.getAttribute("data-content");
const parsedContent = JSON.parse(parsedContentJSON);
const courseContent = document.querySelector(".course-content");
const nextButton = document.querySelector(".button-next");
const draggableItems = document.querySelectorAll('.draggable-item');
const dragZones = document.querySelectorAll('.drag-zone');

document.addEventListener("DOMContentLoaded", function () {
    const convertedHTML = convertMarkdownToHTML(parsedContent);
    courseContent.innerHTML = convertedHTML;

    nextButton.addEventListener("click", function (e) {
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
    });

    if (parsedContent.includes("[drag]")) {
        initDragAndDrop();
    }
});

function showWarningMessage(message) {
    warningAlert.innerHTML = message;
    warningAlert.style.display = "block";
}

function hideWarningMessage() {
    warningAlert.style.display = "none";
}

/**
 * Converts markdown content to HTML with specific formatting for exercises and drag items.
 * 
 * @param {string} markdown - The markdown content to be converted.
 * @returns {string} The converted HTML.
 */
function convertMarkdownToHTML(markdown) {
    const exerciseRegex = /\[exercise\]([\s\S]*?)\[\/exercise\]/g;
    markdown = markdown.replace(exerciseRegex, (match, content) => {
        content = content.replace(/\[ \]/g, '<input type="radio" name="exercise">');
        content = content.replace(/\[x\]/g, '<input type="radio" name="exercise" id="correct">');
        return content;
    });

    const dragRegex = /\[drag\]([\s\S]*?)\[\/drag\]/g;
    const convertedHTML = markdown.replace(dragRegex, (match, content) => {
        const lines = content.trim().split('\n');
        const dragItems = [];
        const dragZones = [];

        lines.forEach(line => {
            if (line.startsWith('[')) {
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
            return '';
        });

        const dragZoneContainers = dragZones.map((zone, index) => {
            const matchResult = zone.match(/^\[(.*?)\]\s*\((\d+)\)$/);
            if (matchResult) {
                const zoneName = matchResult[1].trim();
                const zoneNumber = matchResult[2];
                return `<div class="drag-zone" data-dragzone="${zoneNumber}">${zoneName}</div>`;
            }
            return '';
        });

        return `
            <div class="draggable-container">${dragItemsHTML.join('')}</div>
            <div class="drag-zone-container">${dragZoneContainers.join('')}</div>
        `;
    });

    return convertedHTML;
}

function isMarkedDown() {
    return document.querySelector('input[name="exercise"][id="correct"]:checked') !== null;
}

function areItemsInCorrectZones() {
    let allCorrect = true;
    draggableItems.forEach(item => {
        const parentZone = item.parentElement;
        if (!parentZone.dataset.dragzone || item.dataset.dragzone !== parentZone.dataset.dragzone) {
            item.classList.add('incorrect');
            item.classList.remove('correct');
            allCorrect = false;
        } else {
            item.classList.add('correct');
            item.classList.remove('incorrect');
        }
    });
    return allCorrect;
}

function initDragAndDrop() {
    draggableItems.forEach(item => {
        item.addEventListener('dragstart', handleDragStart);
    });

    dragZones.forEach(zone => {
        zone.addEventListener('dragover', handleDragOver);
        zone.addEventListener('drop', handleDrop);
    });

    dragDropTouch(draggableItems);
}

function handleDragStart(event) {
    event.dataTransfer.setData('text/plain', event.target.dataset.index);
}

function handleDragOver(event) {
    event.preventDefault();
    const dragZone = event.target.dataset.dragzone;
    if (dragZone) {
        event.dataTransfer.dropEffect = 'move';
    }
}

function handleDrop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData('text/plain');
    const draggedItem = document.querySelector(`.draggable-item[data-index="${data}"]`);
    const dragZone = event.target.closest('.drag-zone');

    if (dragZone) {
        dragZone.appendChild(draggedItem);
    }
}
