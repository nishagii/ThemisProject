<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add User</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/admin/add_user.css" />
</head>

<body>
    <div class="new-user-header">
        <h1>Add a New User</h1>
    </div>
    <form class="new-user-form" action="/submitUser" method="post">
        <div class="new-user-form-group">
            <label for="first-name">First Name</label>
            <input
                id="first-name"
                name="firstName"
                type="text"
                placeholder="Enter first name"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="last-name">Last Name</label>
            <input
                id="last-name"
                name="lastName"
                type="text"
                placeholder="Enter last name"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="username">Username</label>
            <input
                id="username"
                name="username"
                type="text"
                placeholder="Enter username"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="email">Email Address</label>
            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter email address"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select role</option>
                <option value="lawyer">Senior Counsel</option>
                <option value="junior">Junior Counsel</option>
                <option value="attorney">Instructing Attorney</option>
                <option value="precedent">Precedents Manager</option>
            </select>
        </div>
        <div class="new-user-form-group">
            <label for="phone">Phone Number</label>
            <input
                id="phone"
                name="phone"
                type="tel"
                placeholder="Enter phone number"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Enter password"
                required />
        </div>
        <div class="new-user-form-group">
            <label for="confirm-password">Confirm Password</label>
            <input
                id="confirm-password"
                name="confirmPassword"
                type="password"
                placeholder="Confirm password"
                required />
        </div>

        <!-- Show Password Checkbox -->
        <div class="new-user-form-group inline">
            <label for="show-password">Show Password</label>
            <input
                type="checkbox"
                id="show-password"
                onclick="togglePasswordVisibility()" />
        </div>

        <div class="new-user-form-group">
            <button type="submit" class="submit-button">Add User</button>
        </div>
    </form>

    <script>
        function togglePasswordVisibility() {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm-password");

            // Toggle between text and password input types
            if (password.type === "password") {
                password.type = "text";
                confirmPassword.type = "text";
            } else {
                password.type = "password";
                confirmPassword.type = "password";
            }
        }
    </script>
</body>

</html>