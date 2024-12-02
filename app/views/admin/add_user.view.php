<!-- <?php
        echo '<pre>';
        print_r($errors);
        echo '</pre>';
        ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add User</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/add_user.css" />
</head>

<body> 
    <?php include('component/navBar.view.php'); ?>
    <?php include('component/sideBar.view.php'); ?>


    <div class="new-user-header">
        <h1>Add a New User</h1>
    </div>
    <form class="new-user-form" action="<?= ROOT ?>/admin" method="POST" novalidate>

        <div class="new-user-form-group">
            <label for="first-name">First Name</label>
            <input
                id="first-name"
                name="firstname"
                type="text"
                placeholder="Enter first name"
                required
                value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" />
            <p class="fname-error"><?= $errors['firstname'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="last-name">Last Name</label>
            <input
                id="last-name"
                name="lastname"
                type="text"
                placeholder="Enter last name"
                required
                value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>" />
            <p class="lname-error"><?= $errors['lastname'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="username">Username</label>
            <input
                id="username"
                name="username"
                type="text"
                placeholder="Enter username"
                required
                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" />
            <p class="username-error"><?= $errors['username'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="email">Email Address</label>
            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter email address"
                required
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
            <p class="email-error"><?= $errors['email'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select role</option>
                <option value="lawyer" <?= ($_POST['role'] ?? '') === 'lawyer' ? 'selected' : '' ?>>Senior Counsel</option>
                <option value="junior" <?= ($_POST['role'] ?? '') === 'junior' ? 'selected' : '' ?>>Junior Counsel</option>
                <option value="attorney" <?= ($_POST['role'] ?? '') === 'attorney' ? 'selected' : '' ?>>Instructing Attorney</option>
                <option value="precedent" <?= ($_POST['role'] ?? '') === 'precedent' ? 'selected' : '' ?>>Precedents Manager</option>
            </select>
            <p class="role-error"><?= $errors['role'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="phone">Phone Number</label>
            <input
                id="phone"
                name="tel"
                type="tel"
                placeholder="Enter phone number"
                required
                value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>" />
            <p class="phone-error"><?= $errors['tel'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Enter password"
                required />
            <p class="password-error"><?= $errors['password'] ?? '' ?></p>
        </div>

        <div class="new-user-form-group">
            <label for="confirm_password">Confirm Password</label>
            <input
                id="confirm_password"
                name="confirm_password"
                type="password"
                placeholder="Confirm password"
                required />
            <p class="confirm-password-error"><?= $errors['confirm_password'] ?? '' ?></p>
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

    <p class="backend-error"><?= $errors['general'] ?? '' ?></p>

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