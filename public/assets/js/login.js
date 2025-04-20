document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Retrieve input values
        const username = form.querySelector('input[name="username"]').value;
        const password = form.querySelector('input[name="password"]').value;
        const rememberMe = form.querySelector('input[name="remember-me"]').checked;

        // Basic validation (customize as needed)
        if (username === '' || password === '') {
            alert('Please enter both username and password.');
            return;
        }

        // Simulate form submission (e.g., send data to server)
        console.log('Username:', username);
        console.log('Password:', password);
        console.log('Remember me:', rememberMe);

        // Clear the form (optional)
        form.reset();

        // Feedback message (customize as needed)
        alert('Login successful!');
    });

    // Toggle Remember me checkbox state
    const rememberMeCheckbox = document.querySelector('#remember-me');
    rememberMeCheckbox.addEventListener('change', function() {
        if (this.checked) {
            console.log('Remember me is checked');
        } else {
            console.log('Remember me is unchecked');
        }
    });

    // Password visibility toggle
    let view = document.getElementById("view");
    let password = document.getElementById("password");

    view.addEventListener('click', function() {
        if (password.type === "password") {
            password.type = "text";
            view.classList.replace('bxs-show', 'bxs-hide'); // Change icon to hide
        } else {
            password.type = "password";
            view.classList.replace('bxs-hide', 'bxs-show'); // Change icon to show
        }
    });
});
