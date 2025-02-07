document.getElementById("addButton").addEventListener("click", function () {
    const innerLeftPanel = document.getElementById("inner_left_panel");

    // Example content/component to display
    const newContent = document.createElement("div");
    let userListHTML = users.map(user => 
        `<div class="contact contact-item" 
             onclick="start_chat(event, '${user.first_name} ${user.last_name}')"
             style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; cursor: pointer;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>${user.first_name} ${user.last_name}</h5>
        </div>`
    ).join("");
    
    

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
    xml.onload = function () {
        if (xml.readyState === 4 && xml.status === 200) {
            try {
                var response = JSON.parse(xml.responseText);
                handle_result(response, type);
            } catch (e) {
                console.error("Error parsing JSON response:", e, xml.responseText);
            }
        }
    };

    var data = JSON.stringify({ find: find, data_type: type });

    xml.open("POST", "YOUR_ENDPOINT_URL", true);
    xml.setRequestHeader("Content-Type", "application/json"); // Ensuring JSON format
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

function start_chat(event, userName) {
    console.log("start_chat function called with userName:", userName); // Debugging log

    const messageDiv = document.querySelector(".message");
    const innerRightPanel = document.getElementById("inner_right_panel");

    if (!innerRightPanel) {
        console.error("Error: inner_right_panel not found!"); // Debugging log
        return; 
    }

    if (messageDiv) {
        let userList = document.getElementById("selectedUsersList");

        // Create the list container if it doesn't exist
        if (!userList) {
            userList = document.createElement("ul");
            userList.id = "selectedUsersList";
            userList.style.listStyle = "none";
            userList.style.padding = "10px 0";
            userList.style.textAlign = "center"; // Center the list items
            messageDiv.appendChild(userList);
        }

        // Check if the username is already in the list
        const existingUser = [...userList.children].find(li => li.dataset.username === userName);
        if (!existingUser) {
            const userItem = document.createElement("li");
            userItem.dataset.username = userName;
            userItem.style.padding = "10px 0";
            userItem.style.color = "#007bff";
            userItem.style.cursor = "pointer";
            userItem.style.fontWeight = "500";
            userItem.style.transition = "background 0.3s ease-in-out";
            userItem.style.fontSize = "15px";
            userItem.style.position = "relative";
            userItem.style.display = "flex";
            userItem.style.flexDirection = "column"; // Ensure line appears below text
            userItem.style.alignItems = "center"; // Center the content

            // Add hover effect
            userItem.addEventListener("mouseenter", () => {
                userItem.style.backgroundColor = "#f0f0f0"; // Light gray hover effect
                userItem.style.borderRadius = "5px";
            });

            userItem.addEventListener("mouseleave", () => {
                userItem.style.backgroundColor = "transparent";
            });

            // Container for icon and username
            const userContent = document.createElement("div");
            userContent.style.display = "flex";
            userContent.style.alignItems = "center";
            userContent.style.gap = "10px"; // Space between icon and text

            // Create the user icon
            const userIcon = document.createElement("i");
            userIcon.className = "bx bx-user";
            userIcon.style.fontSize = "35px";
            userIcon.style.color = "#a8a8a9";

            // Create the username text
            const userNameSpan = document.createElement("span");
            userNameSpan.textContent = userName;

            // Append icon and username to the container
            userContent.appendChild(userIcon);
            userContent.appendChild(userNameSpan);

            // Create a short horizontal line
            const hr = document.createElement("div");
            hr.style.width = "80%"; // Shorter width (not full width)
            hr.style.height = "0.5px";
            hr.style.backgroundColor = "#ccc"; // Light gray color
            hr.style.marginTop = "8px";
            hr.style.borderRadius = "2px";

            // Append the content and horizontal line
            userItem.appendChild(userContent);
            userItem.appendChild(hr);

            // Append the new user to the list
            userList.appendChild(userItem);

            // **When user is clicked, update the right panel**
            userItem.addEventListener("click", () => {
                console.log("User clicked:", userName); // Debugging log
                innerRightPanel.innerHTML = `
    <h2>Chat with ${userName}</h2>
    <div class="chat-bubble received">Hello ${userName}, how can I help you?</div>
    <div class="chat-bubble">Hi ${userName}, let's start our conversation!</div>
`;

            });
        }
    }

    // **Ensure inner_right_panel updates when function runs**
    console.log("Updating inner_right_panel...");
    innerRightPanel.innerHTML = `
    <h2>Chat with ${userName}</h2>
    <div class="chat-bubble received">Hello ${userName}, how can I help you?</div>
    <div class="chat-bubble">Hi ${userName}, let's start our conversation!</div>
`;


    // Move to the inner_right_panel smoothly
    innerRightPanel.scrollIntoView({ behavior: "smooth" });

    // Close the newContent panel if it exists
    const newContent = document.getElementById("newComponent");
    if (newContent) {
        newContent.remove();
    }
}
























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
