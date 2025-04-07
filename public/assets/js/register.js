document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        // Clear previous errors
        document.querySelectorAll('.form p').forEach((p) => {
            p.textContent = '';
            p.style.display = 'none'; // Hide the error messages
        });

        const formData = new FormData(form);
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        // If there are validation errors from server-side
        if (result.errors) {
            Object.keys(result.errors).forEach((key) => {
                const errorElement = document.querySelector(`.${key}-error`);
                if (errorElement) {
                    errorElement.textContent = result.errors[key];
                    errorElement.style.display = 'block';
                }
            });
        }

        // If registration was successful redirects to success.html
        if (result.success) {
            window.location.href = 'success.html';
        }

        // Prevent form submission if there are errors
        event.preventDefault();
    });
});
