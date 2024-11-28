<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases List</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/case.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php if (!empty($_SESSION['success'])): ?>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    title: 'Success!',
                    text: "<?= $_SESSION['success'] ?>",
                    icon: 'success',
                    timer: 2000, // Time in milliseconds
                    showConfirmButton: false,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'swal2-background'
                    }
                });
            });
        </script>
        <?php unset($_SESSION['success']); // Clear the message 
        ?>
    <?php endif; ?>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <h1>List of Cases</h1>
    <div class="button">
        <a href="<?= ROOT ?>/cases">
            <button class="add">Add New Case</button>
        </a>
        <a href="<?= ROOT ?>/cases/retrieveAllCases">
            <button class="add">Card View</button>
        </a>
    </div>
    <div class="table-container">
        <table border="1" cellpadding="10" cellspacing="0" class="template-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Case Number</th>
                    <th>Court</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cases)) : ?>
                    <?php foreach ($cases as $index => $case) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($case->client_name) ?></td>
                            <td><?= htmlspecialchars($case->case_number) ?></td>
                            <td><?= htmlspecialchars($case->court) ?></td>
                            <td><?= htmlspecialchars($case->notes) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                        <button class="more">View</button>
                                    </a>
                                    <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                                        <button class="edit">
                                            <i class="bx bx-edit"></i> <!-- Boxicon for Edit -->
                                        </button>
                                    </a>
                                    <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)">
                                        <button class="delete">
                                            <i class="bx bx-trash"></i> <!-- Boxicon for Delete -->
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No cases found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- -------------------------------------JavaScript------------------------------------- -->
    <script>
        function confirmDelete(caseId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this case? This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#93a8e3',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete action
                    window.location.href = `<?= ROOT ?>/cases/deleteCase/${caseId}`;
                }
            });
        }
    </script>
</body>

</html>