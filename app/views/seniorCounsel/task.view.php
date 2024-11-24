<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->

</head>
<body>


    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    
    <div class="parent-container">
        <div class="counters-container">
            <div class="counter total">
                <div class="counter-icon">
                    <i class="fas fa-tasks"></i> <!-- Updated icon -->
                </div>
                <strong>Total No of Tasks Assigned:</strong>
                <span class="total-users">200</span>
            </div>
            <div class="individual">
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-spinner"></i> <!-- Icon for active tasks -->
                    </div>
                    <h3>Active Tasks</h3>
                    <span>50</span>
                </div>
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-check-circle"></i> <!-- Icon for completed tasks -->
                    </div>
                    <h3>Completed Tasks</h3>
                    <span>25</span>
                </div>
                <div class="counter">
                    <div class="counter-icon">
                        <i class="fas fa-times-circle"></i> <!-- Icon for incomplete tasks -->
                    </div>
                    <h3>Incomplete Tasks</h3>
                    <span>25</span>
                </div>
            </div>
        </div>
        <div class="add">
                <button data-modal-target="#modal" class="add-button" >
                    <i class="bx bx-plus"></i> Assign New Task
                </button>
        </div>

        <div class="modal" id="modal">
    <div class="modal-header">
        <div class="title">
            Assign a Task
        </div>
        <button data-close-button class="close-button">
            &times;
        </button>
    </div>
    <div class="modal-body">
        <form id="taskForm">
            <div class="form-group">
                <label for="taskName">Task Name:</label>
                <input type="text" id="taskName" name="taskName" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="assignee">Assign To:</label>
                <select id="assignee" name="assignee" required>
                    <option value="" disabled selected>Select a user</option>
                    <option value="user1">User 1</option>
                    <option value="user2">User 2</option>
                    <option value="user3">User 3</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="deadlineDate">Deadline Date:</label>
                <input type="date" id="deadlineDate" name="deadlineDate" required>
            </div>
            
            <div class="form-group">
                <label for="deadlineTime">Deadline Time:</label>
                <input type="time" id="deadlineTime" name="deadlineTime" required>
            </div>
            
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select id="priority" name="priority" required>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="attachments">Add Attachments (Max 4):</label>
                <input type="file" id="attachments" name="attachments" multiple accept=".jpg,.png,.pdf,.doc,.docx">
                <small>Allowed formats: JPG, PNG, PDF, DOC, DOCX</small>
            </div>
            
            <div class="form-actions">
                <button type="submit">Assign Task</button>
            </div>
        </form>
    </div>
</div>


    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openModalButtons = document.querySelectorAll('[data-modal-target]');
            const closeModalButtons = document.querySelectorAll('[data-close-button]');

            openModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = document.querySelector(button.dataset.modalTarget);
                    modal.classList.add('active');
                });
            });

            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = button.closest('.modal');
                    modal.classList.remove('active');
                });
            });
        });

        document.getElementById('attachments').addEventListener('change', function () {
    if (this.files.length > 4) {
        alert('You can only upload up to 4 files.');
        this.value = ''; // Clear the file input
    }
});

    </script>

        

</body>
</html>
