<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/addHomework.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form method="POST" action="<?= ROOT?>/Homework/updateHomework/<?= htmlspecialchars($homework[0]->homeworkID)?>">
            <label for="subject">Subject Name:</label>
            <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($homework[0]->subject)?>"> <br>
            <?php if(isset($errors['subject'])): ?>
                <p class="error"><?= htmlspecialchars($errors['subject']) ?></p>
            <?php endif; ?>


            <label for="desc">Home Description:</label>
            <textarea id="desc" name="desc"><?= htmlspecialchars($homework[0]->desc)?></textarea> <br>
            <?php if(isset($errors['desc'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['desc']) ?> </p>
            <?php endif; ?>

            <label for="deadlineDate">Deadline Date:</label>
            <input type="date" name="deadlineDate" id="deadlineDate" value="<?= htmlspecialchars($homework[0]->deadlineDate)?>"> <br>
            <?php if(isset($errors['deadlineDate'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['deadlineDate']) ?> </p>
            <?php endif; ?>

            <label for="deadlineTime">Deadline Time:</label>
            <input type="time" name="deadlineTime" id="deadlineTime" value="<?= htmlspecialchars($homework[0]->deadlineTime)?>"> <br>
            <?php if(isset($errors['deadlineTime'])): ?>
                <p class="error"> <?= htmlspecialchars($errors['deadlineTime']) ?> </p>
            <?php endif; ?>
            


            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="high" <?= ($homework[0]->priority == 'high') ? 'selected' : '' ?>>High</option>
                <option value="medium" <?= ($homework[0]->priority == 'medium') ? 'selected' : '' ?>>Medium</option>
                <option value="low" <?= ($homework[0]->priority == 'low') ? 'selected' : '' ?>>Low</option>
            </select> 
            <?php if(isset($errors['priority'])): ?>
                <p class="error"><?= htmlspecialchars($errors['priority']) ?> </p>
            <?php endif; ?> <br>
            <input type="submit" value="Edit">
            
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dateInput = document.getElementById('deadlineDate');
            const timeInput = document.getElementById('deadlineTime');
            const form = document.querySelector('form');
            
            // Create error element for datetime validation
            const errorElement = document.createElement("p");
            errorElement.className = "error";
            errorElement.id = "datetime-error";
            errorElement.style.display = "none";
            
            // Insert error element after time input
            timeInput.parentNode.insertBefore(errorElement, timeInput.nextSibling);
            
            // Set minimum date to today
            const today = new Date();
            const todayDate = today.toISOString().split('T')[0];
            dateInput.setAttribute('min', todayDate);
            
            // Add form submission validation
            form.addEventListener('submit', (e) => {
                // Hide error message initially
                errorElement.style.display = "none";
                
                if (dateInput.value) {
                    const selectedDate = new Date(dateInput.value);
                    const currentDate = new Date();
                    
                    // If selected date is today, check time
                    if (selectedDate.toDateString() === currentDate.toDateString()) {
                        const timeValue = timeInput.value;
                        if (timeValue) {
                            const [hours, minutes] = timeValue.split(':');
                            
                            // Set time on selected date for comparison
                            selectedDate.setHours(parseInt(hours), parseInt(minutes), 0, 0);
                            
                            // If selected datetime is in the past, prevent form submission
                            if (selectedDate <= currentDate) {
                                e.preventDefault();
                                errorElement.textContent = "Deadline cannot be in the past. Please select a future time.";
                                errorElement.style.display = "block";
                            }
                        }
                    }
                }
            });
            
            // Clear validation message when input changes
            timeInput.addEventListener('input', () => {
                errorElement.style.display = "none";
            });
            
            dateInput.addEventListener('input', () => {
                errorElement.style.display = "none";
            });
        });
    </script>
</body>
</html>