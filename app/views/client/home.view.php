<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Lawyer Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('login') === 'success') {
            Swal.fire({
                title: 'Welcome Back!',
                text: 'You have successfully logged in.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
            });
        }
    </script>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>

</body>

</html>