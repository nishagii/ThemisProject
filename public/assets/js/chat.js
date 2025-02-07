document.getElementById("addButton").addEventListener("click", function () {
    const innerLeftPanel = document.getElementById("inner_left_panel");

    // Example content/component to display
    const newContent = document.createElement("div");
    let userListHTML = users.map(user => `
        <div class="contact contact-item" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; cursor: pointer;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>${user.first_name} ${user.last_name}</h5>
        </div>
    `).join("");
    

    newContent.innerHTML = `
        <i class='bx bx-x-circle' id="closeButton" style="cursor: pointer;"></i>
        <div class="message">
            <h4>Contacts</h4>
        </div>
        <div id="scrollableContent" style="overflow-y: auto; max-height: calc(100vh - 50px); padding: 10px;">
            ${userListHTML}
        </div>
    `;
    newContent.id = "newComponent";

    // Style the newContent to overlap the panel
    newContent.style.position = "absolute";
    newContent.style.top = "0";
    newContent.style.left = "0";
    newContent.style.width = `${innerLeftPanel.offsetWidth}px`; // Dynamically set the width
    // newContent.style.height = "100%";
    newContent.style.zIndex = "10";
    newContent.style.borderRight = "0.5px solid rgb(214, 214, 214)";
    newContent.style.background = "#fff"; // Ensure it has a background
    newContent.style.display = "flex";
    newContent.style.flexDirection = "column";

    // Style the close button
    const closeButton = newContent.querySelector("#closeButton");
    closeButton.style.position = "absolute";
    closeButton.style.top = "10px";
    closeButton.style.right = "10px";
    closeButton.style.fontSize = "20px";
    closeButton.style.color = "#a8a8a9";

    // Append new content/component
    innerLeftPanel.appendChild(newContent);

    // Add close functionality
    closeButton.addEventListener("click", function () {
        innerLeftPanel.removeChild(newContent);
    });
});





// Function to get an element by its ID
function _(element) {
    return document.getElementById(element);
}

function get_data(find, type) {

    var xml = new XMLHttpRequest();
    xml.onload = function() {

        if (xml.readyState == 4 || xml.status == 200) {
            handle_result(xml.responseText, type);
        }
    }
    var data = {};
    data.find = find;
    data.data_type = type;

    data = JSON.stringify(data);

    xml.open("POST", "", true);
    xml.send(data);
}

function handle_result(result, type) {

    if (result.trim() != "") {

        var obj = JSON.parse(result);
        if (!obj.logged_in) {
            window.location == ROOT + "/Login.php"
        }else {

            //alert(result);
        }
    }
    
}

get_data({}, "user_info");



















// Automatically load data into inner_left_panel on page load
// window.addEventListener("DOMContentLoaded", function () {
//     console.log("Page loaded. Attempting to fetch data for inner_left_panel.");

//     // Reference to the inner panel
//     var inner_panel = _("inner_left_panel");

//     // Create an XMLHttpRequest object
//     var ajax = new XMLHttpRequest();
    

//     // Set up the AJAX request
//     ajax.onload = function () {
//         console.log("AJAX onload triggered.");
//         if (ajax.status == 200 && ajax.readyState == 4) {
//             console.log("AJAX success. Response received:");
//             console.log(ajax.responseText); // Log the response for debugging
//             inner_panel.innerHTML = ajax.responseText; // Update the inner panel
//         } else {
//             console.error("AJAX failed. Status:", ajax.status, "State:", ajax.readyState);
//         }
//     };

//     ajax.onerror = function () {
//         console.error("AJAX error occurred.");
//     };

//     ajax.onprogress = function () {
//         console.log("AJAX in progress...");
//     };

//     ajax.open("GET", ROOT + "/assets/js/js.php", true);
//     console.log("AJAX request sent for js.txt.");
//     ajax.send();
// });
