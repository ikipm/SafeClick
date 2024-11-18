document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('overlay');
    const showButton = document.getElementById('show-button');
    const closeButton = document.getElementById('close-button');

    // Show form when button pressed
    showButton.onclick = function() {
        overlay.style.display = 'flex'; // Flex to center the content
    };

    // Close overlay when close button is clicked
    closeButton.onclick = function() {
        overlay.style.display = 'none';
    };

    // Close overlay when clicking outside the form
    overlay.onclick = function(event) {
        if (event.target === overlay) {
            overlay.style.display = 'none';
        }
    };

    // Close overlay when pressing the escape key
    document.onkeydown = function(event) {
        if (event.key === 'Escape') {
            overlay.style.display = 'none';
        }
    };
});
