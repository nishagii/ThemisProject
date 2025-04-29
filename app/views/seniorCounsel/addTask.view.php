<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/task.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- this is imported to use icons -->
</head>
<body>

    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">

    <div class="form-body">

        <div class="modal" id="modal">
                        <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <?php foreach ($errors as $field => $error): ?>
                            <p><?= ucfirst($field) ?>: <?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


            <div class="modal-header">
                <div class="title">Assign a Task</div>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= ROOT ?>/addTask/add" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input type="text" id="name" name="name">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>

                   
                    
                    <div class="form-group">
                        <label for="assigneeID">Assign To:</label>
                        <select id="assigneeID" name="assigneeID">
                            <option value="" disabled selected>Select a user</option>
                            <?php if ($users): ?>
                                <?php foreach ($users as $user): ?>
                                                            <option value="<?php echo htmlspecialchars($user->id); ?>">
                                        <?php echo htmlspecialchars($user->first_name . ' ' . $user->last_name); ?> (<?php echo htmlspecialchars($user->role); ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No users available</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="deadlineDate">Deadline Date:</label>
                        <input type="date" id="deadlineDate" name="deadlineDate" >
                    </div>
                    
                    <div class="form-group">
                        <label for="deadlineTime">Deadline Time:</label>
                        <input type="time" id="deadlineTime" name="deadlineTime">
                    </div>
                    
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select id="priority" name="priority" >
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    
                    
                    <div class="form-actions">
                        <button type="submit">Assign Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    

                <script>
   
    function validateDateAndTime() {
    const today = new Date();
    const dateInput = document.getElementById("deadlineDate");
    const timeInput = document.getElementById("deadlineTime");

   
    const todayDate = today.toISOString().split('T')[0]; 

    
    dateInput.setAttribute('min', todayDate);

   
    dateInput.addEventListener('change', function () {
        const selectedDate = new Date(`${dateInput.value}T${timeInput.value}`); 
        if (selectedDate < today) {
            alert('Deadline date and time cannot be in the past.');
            dateInput.value = ''; 
        }
    });

  
    timeInput.addEventListener('change', function () {
        if (!dateInput.value) {
            alert('Please select a date first.');
            timeInput.value = '';
            return;
        }

        const selectedDate = new Date(`${dateInput.value}T${timeInput.value}`);
        if (selectedDate < today) {
            alert('Deadline date and time cannot be in the past.');
            timeInput.value = ''; 
        }
    });
}


document.addEventListener('DOMContentLoaded', validateDateAndTime);



document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const errorMessages = {};

    form.addEventListener("submit", function (event) {
       
        clearErrors();

      
        let isValid = true;

       
        isValid &= validateRequired("name", "Task name is required.");

      
        isValid &= validateRequired("description", "Description is required.");

      
        isValid &= validateRequired("assigneeID", "Assignee is required.");

      
        isValid &= validateRequired("deadlineDate", "Deadline date is required.");

       
        isValid &= validateRequired("deadlineTime", "Deadline time is required.");
        isValid &= validateTimeNotInPast("deadlineTime", "Deadline time cannot be in the past.");

      
        if (!isValid) {
            event.preventDefault();
        }
    });

   
    function validateRequired(id, message) {
        const field = document.getElementById(id);
        if (field.value.trim() === "") {
            showError(id, message);
            return false;
        }
        return true;
    }

  
    function validateDateNotInPast(id, message) {
        const field = document.getElementById(id);
        const today = new Date().toISOString().split('T')[0];
        if (field.value < today) {
            showError(id, message);
            return false;
        }
        return true;
    }

   
    function validateTimeNotInPast(id, message) {
        const dateField = document.getElementById("deadlineDate");
        const timeField = document.getElementById(id);
        const selectedDateTime = new Date(`${dateField.value}T${timeField.value}`);

        if (selectedDateTime < new Date()) {
            showError(id, message);
            return false;
        }
        return true;
    }

    
    function showError(id, message) {
        const field = document.getElementById(id);
        const errorElement = document.createElement("div");
        errorElement.className = "error-message";
        errorElement.innerText = message;
        field.parentElement.appendChild(errorElement);
    }

   
    function clearErrors() {
        document.querySelectorAll(".error-message").forEach((element) => element.remove());
    }
});

</script>

</body>
</html>
