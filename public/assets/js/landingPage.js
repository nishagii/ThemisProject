const text = "Legally yours!";
const speed = 100; // Speed of the typing effect in milliseconds
let i = 0;

function typeWriter() {
    if (i < text.length) {
        document.getElementById("typed-text").textContent += text.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    typeWriter();
});

// Get the search icon and search bar elements
const searchIcon = document.getElementById('search-icon');
const searchBar = document.getElementById('search-bar');

// Add click event listener to the search icon
searchIcon.addEventListener('click', (event) => {
    // Stop the event from propagating to the document
    event.stopPropagation();
    // Toggle the 'active' class to show or hide the search bar
    searchBar.classList.toggle('active');
});

// Add click event listener to the document
document.addEventListener('click', (event) => {
    // Check if the click is outside the search bar and the search icon
    if (!searchBar.contains(event.target) && !searchIcon.contains(event.target)) {
        // Hide the search bar by removing the 'active' class
        searchBar.classList.remove('active');
    }
});
