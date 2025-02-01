import { createNewContent } from "./newContent.js";

document.getElementById("addButton").addEventListener("click", function () {
    const innerLeftPanel = document.getElementById("inner_left_panel");

    // Remove existing newComponent if it exists
    const existingComponent = document.getElementById("newComponent");
    if (existingComponent) {
        innerLeftPanel.removeChild(existingComponent);
    }

    // Create and append the new content
    const newContent = createNewContent(innerLeftPanel);
    innerLeftPanel.appendChild(newContent);
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
