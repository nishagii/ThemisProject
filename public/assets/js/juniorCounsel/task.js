//taskboard
const tabs = document.querySelectorAll('.tab_btn');
const all_content = document.querySelectorAll('.content');

// Function to position the line
function positionLine(targetElement) {
    var line = document.querySelector('.line');
    line.style.width = targetElement.offsetWidth + "px";
    line.style.left = targetElement.offsetLeft + "px";
}

// Set the initial position of the line when the page loads
window.addEventListener('DOMContentLoaded', () => {
    // Find the active tab
    const activeTab = document.querySelector('.tab_btn.active');
    if (activeTab) {
        positionLine(activeTab);
    }
});

tabs.forEach((tab, index) => {
    tab.addEventListener('click', (e) => {
        // Remove 'active' class from all tabs and add it to the clicked tab
        tabs.forEach(tab => tab.classList.remove('active'));
        tab.classList.add('active');
        
        // Update the position and width of the line
        positionLine(e.target);
        
        // Show the corresponding content and hide others
        all_content.forEach(content => content.classList.remove('active'));
        all_content[index].classList.add('active');
    });
});

function completeTask(taskID) {
    // Show SweetAlert with confirmation message
    Swal.fire({
        icon: 'info',
        title: 'Task Completion Sent for Review',
        text: 'This task will be reviewed before final completion.',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to complete the task action
            window.location.href = "<?= ROOT ?>/task/complete/" + taskID;
        }
    });
}