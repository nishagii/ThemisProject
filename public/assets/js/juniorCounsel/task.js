//taskboard 

const tabs = document.querySelectorAll('.tab_btn');
const all_content = document.querySelectorAll('.content');

tabs.forEach((tab, index) => {
    tab.addEventListener('click', (e) => {
        // Remove 'active' class from all tabs and add it to the clicked tab
        tabs.forEach(tab => tab.classList.remove('active'));
        tab.classList.add('active');

        // Update the position and width of the line
        var line = document.querySelector('.line');
        line.style.width = e.target.offsetWidth + "px";
        line.style.left = e.target.offsetLeft + "px";

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