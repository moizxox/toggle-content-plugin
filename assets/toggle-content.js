document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-button');
    const contentItems = document.querySelectorAll('.toggle-content-item');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and content items
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            contentItems.forEach(item => item.classList.remove('active'));

            // Add active class to the clicked button and the corresponding content item
            this.classList.add('active');
            document.querySelector(`.${this.getAttribute('data-target')}`).classList.add('active');
        });
    });
});