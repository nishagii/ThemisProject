<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases List</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/case.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Status badge styles */
        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: bold;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-ongoing {
            background-color: rgba(59, 209, 124, 0.55);
            color: white;
        }

        .status-closed {
            background-color: rgba(254, 94, 94, 0.81);
            color: white;

        }

        /* Status dropdown styles */
        .status-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 8px;
        }

        .status-select {
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            color: #1d1b31;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-grow: 1;
        }

        .status-select:hover,
        .status-select:focus {
            border-color: #fa9800;
            outline: none;
        }

        .update-status-btn {
            background-color: #fa9800;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .update-status-btn:hover {
            background-color: #e08800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Option styles for dropdown */
        .status-select option {
            padding: 8px;
            font-weight: 500;
        }

        /* Case card hover effect */
        .case-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .case-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Tab styles */
        .cases-tabs {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            border-bottom: 2px solid #eee;
        }

        .tab-button {
            padding: 10px 20px;
            margin: 0 10px;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 600;
            color: #777;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-button:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #fa9800;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tab-button.active {
            color: #1d1b31;
        }

        .tab-button.active:after {
            transform: scaleX(1);
        }

        .tab-button:hover {
            color: #1d1b31;
        }

        .cases-section {
            display: none;
        }

        .cases-section.active {
            display: block;
        }

        .section-title {
            margin: 20px 0;
            font-size: 1.2em;
            color: #1d1b31;
            font-weight: 600;
            text-align: center;
        }

        .no-cases-message {
            text-align: center;
            padding: 20px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <div class="home-section">
        <div class="allcases-section">
            <h1>List of All Cases</h1>
        </div>
        <div class="paragraph-all-cases">
            Click here to add a
            <span style="color: #fa9800; font-weight: bold;">new case</span> or to view details in
            <span style="color: #fa9800; font-weight: bold;">tabular view</span>.
        </div>

        <div class="button">
            <a href="<?= ROOT ?>/cases">
                <button class="add">Add New Case</button>
            </a>
            <a href="<?= ROOT ?>/cases/extendRetrieveAllCases">
                <button class="add">Tabular View</button>
            </a>
        </div>

        <!-- Case Status Tabs -->
        <div class="cases-tabs">
            <button class="tab-button active" data-tab="all-cases">All Cases</button>
            <button class="tab-button" data-tab="ongoing-cases">Ongoing Cases</button>
            <button class="tab-button" data-tab="closed-cases">Closed Cases</button>
        </div>

        <!-- All Cases Section -->
        <div class="cases-section active" id="all-cases">
            <div class="cases-container">
                <?php if (!empty($cases)) : ?>
                    <?php foreach ($cases as $case) : ?>
                        <div class="case-card">
                            <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-<?= $case->case_status ?? 'ongoing' ?>">
                                Status: <?= ucfirst(htmlspecialchars($case->case_status ?? 'ongoing')) ?>
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-<?= $case->id ?>">
                                    <option value="ongoing" <?= ($case->case_status == 'ongoing' || empty($case->case_status)) ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="closed" <?= ($case->case_status == 'closed') ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>)">Update Status</button>
                            </div>

                            <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
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
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No cases found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ongoing Cases Section -->
        <div class="cases-section" id="ongoing-cases">
            <div class="cases-container">
                <?php
                $ongoingCases = array_filter($cases ?? [], function ($case) {
                    return $case->case_status == 'ongoing' || empty($case->case_status);
                });

                if (!empty($ongoingCases)) :
                ?>
                    <?php foreach ($ongoingCases as $case) : ?>
                        <!-- Inside each case card in all three sections (all, ongoing, closed) -->
                        <div class="case-card">
                            <h3 title="<?= htmlspecialchars($case->case_number) ?>">Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-<?= $case->case_status ?? 'ongoing' ?>">
                                Status: <?= ucfirst(htmlspecialchars($case->case_status ?? 'ongoing')) ?>
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-<?= $case->id ?>">
                                    <option value="ongoing" <?= ($case->case_status == 'ongoing' || empty($case->case_status)) ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="closed" <?= ($case->case_status == 'closed') ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>)">Update Status</button>
                            </div>

                            <div class="notes-container">
                                <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>
                            </div>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
                                </a>

                                <a href="<?= ROOT ?>/cases/editCase/<?= $case->id; ?>">
                                    <button class="edit">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $case->id; ?>)">
                                    <button class="delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No ongoing cases found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Closed Cases Section -->
        <div class="cases-section" id="closed-cases">
            <div class="cases-container">
                <?php
                $closedCases = array_filter($cases ?? [], function ($case) {
                    return $case->case_status == 'closed';
                });

                if (!empty($closedCases)) :
                ?>
                    <?php foreach ($closedCases as $case) : ?>
                        <div class="case-card">
                            <h3>Case Number: <?= htmlspecialchars($case->case_number) ?></h3>
                            <p><strong>Client Name:</strong> <?= htmlspecialchars($case->client_name) ?></p>
                            <p><strong>Court:</strong> <?= htmlspecialchars($case->court) ?></p>

                            <!-- Case Status Badge -->
                            <div class="status-badge status-closed">
                                Status: Closed
                            </div>

                            <!-- Status Update Form -->
                            <div class="status-container">
                                <select class="status-select" id="status-closed-<?= $case->id ?>">
                                    <option value="ongoing">Ongoing</option>
                                    <option value="closed" selected>Closed</option>
                                </select>
                                <button class="update-status-btn" onclick="updateCaseStatus(<?= $case->id ?>, 'closed')">Update Status</button>
                            </div>

                            <p><strong>Notes:</strong> <?= htmlspecialchars($case->notes) ?></p>

                            <div class="button">
                                <a href="<?= ROOT ?>/cases/retrieveCase/<?= $case->id; ?>">
                                    <button class="more">Open Case</button>
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
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-cases-message">No closed cases found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const casesSections = document.querySelectorAll('.cases-section');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons and sections
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    casesSections.forEach(section => section.classList.remove('active'));

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Show corresponding section
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });

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

        function updateCaseStatus(caseId, tabPrefix = '') {
            const selectId = tabPrefix ? `status-${tabPrefix}-${caseId}` : `status-${caseId}`;
            const newStatus = document.getElementById(selectId).value;

            Swal.fire({
                title: 'Update Case Status',
                text: `Change status to ${newStatus.toUpperCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#fa9800',
                cancelButtonColor: '#1d1b31',
                confirmButtonText: 'Yes, update it!',
                background: '#fafafa',
                color: '#1d1b31',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to update status
                    fetch(`<?= ROOT ?>/cases/updateStatus/${caseId}/${newStatus}`, {
                            method: 'POST',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Case status updated successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#fa9800',
                                    background: '#fafafa',
                                    color: '#1d1b31',
                                }).then(() => {
                                    // Reload the page to show updated status
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.message || 'Failed to update case status',
                                    icon: 'error',
                                    confirmButtonColor: '#fa9800',
                                    background: '#fafafa',
                                    color: '#1d1b31',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                                confirmButtonColor: '#fa9800',
                                background: '#fafafa',
                                color: '#1d1b31',
                            });
                        });
                }
            });
        }
    </script>


</body>

</html>