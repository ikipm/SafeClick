document.addEventListener('DOMContentLoaded', () => {
    const idCardOverlay = document.getElementById('id-card-overlay');
    const showIdCard = document.getElementById('show-id-card');
    const closeIdCard = document.getElementById('close-id-card');
    const form = document.querySelector('.id-card form');

    // Show id-card
    showIdCard.addEventListener('click', () => {
        idCardOverlay.classList.add('active');
    });

    // Close id-card when close button is clicked
    closeIdCard.addEventListener('click', () => {
        idCardOverlay.classList.remove('active');
    });

    // Close id-card on Escape key press
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && idCardOverlay.classList.contains('active')) {
            idCardOverlay.classList.remove('active');
        }
    });
});
