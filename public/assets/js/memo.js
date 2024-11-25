document.addEventListener("DOMContentLoaded", () => {
    const settingsIcon = document.getElementById("settings-icon");
    const settingsMenu = document.getElementById("settings-menu");

    // Toggle visibility on click
    settingsIcon.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default behavior of <a> tag
        event.stopPropagation(); // Prevent bubbling
        settingsMenu.classList.toggle("active"); // Toggle active class
    });

    // Close menu when clicking outside
    document.addEventListener("click", () => {
        settingsMenu.classList.remove("active");
    });

    // Prevent menu from closing when clicking inside it
    settingsMenu.addEventListener("click", (event) => {
        event.stopPropagation();
    });
});
