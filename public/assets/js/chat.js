// Global variables
let currentUserId = userId;
let isTyping = false;
let refreshInterval;

// Initialize auto-refresh
setupAutoRefresh();

document.getElementById("addButton").addEventListener("click", function () {
    const innerLeftPanel = document.getElementById("inner_left_panel");

    const newContent = document.createElement("div");
    let userListHTML = users.map(user => 
        `<div class="contact contact-item" 
             onclick="start_chat(event, '${user.first_name} ${user.last_name}', '${user.id}')"
             style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; cursor: pointer;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>${user.first_name} ${user.last_name}</h5>
        </div>`
    ).join("");
    
    newContent.innerHTML = 
        `<i class='bx bx-x-circle' id="closeButton" style="cursor: pointer;"></i>
        <div class="message">
            <h4>Contacts</h4>
        </div>
        <div id="scrollableContent" style="overflow-y: auto; max-height: calc(100vh - 50px); padding: 10px;">
            ${userListHTML}
        </div>`;
    newContent.id = "newComponent";

    // Style the newContent
    newContent.style.position = "absolute";
    newContent.style.top = "0";
    newContent.style.left = "0";
    newContent.style.width = `${innerLeftPanel.offsetWidth}px`;
    newContent.style.zIndex = "10";
    newContent.style.borderRight = "0.5px solid rgb(214, 214, 214)";
    newContent.style.background = "#fff";
    newContent.style.display = "flex";
    newContent.style.flexDirection = "column";

    // Style the close button
    const closeButton = newContent.querySelector("#closeButton");
    closeButton.style.position = "absolute";
    closeButton.style.top = "10px";
    closeButton.style.right = "10px";
    closeButton.style.fontSize = "20px";
    closeButton.style.color = "#a8a8a9";

    // Append new content
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
    console.log("Sending data:", {
        message: find.message,
        sender: find.userid,
        receiver: find.receiverid,
        type: type
    });

    var xml = new XMLHttpRequest();
    
    xml.onload = function () {
        if (xml.readyState === 4) {
            if (xml.status === 200) {
                try {
                    var response = JSON.parse(xml.responseText);
                    console.log("Server received:", {
                        data: response,
                        requestType: type,
                        timestamp: new Date().toISOString()
                    });
                } catch (e) {
                    console.error("Error parsing JSON response:", e);
                    console.error("Raw response:", xml.responseText);
                }
            } else {
                console.error("HTTP Error:", xml.status, xml.statusText);
            }
        }
    };
    
    xml.onerror = function () {
        console.error("Network Error:", {
            url: "http://localhost/themisrepo/public/chat",
            data: find,
            type: type
        });
    };
    
    var data = JSON.stringify({ 
        find: find, 
        data_type: type 
    });

    console.log("JSON being sent to server:", data);
    
    xml.open("POST", "http://localhost/themisrepo/public/chat", true);
    xml.setRequestHeader("Content-Type", "application/json");
    xml.send(data);
}

function start_chat(event, userName, receiverId) {
    console.log("start_chat function called with userName:", userName, "Receiver ID:", receiverId);

    const messageDiv = document.querySelector(".message");
    const innerRightPanel = document.getElementById("inner_right_panel");
    const messageInputArea = document.querySelector(".message-input");

    if (!innerRightPanel) {
        console.error("Error: inner_right_panel not found!");
        return;
    }

    const msgId = `${currentUserId}and${receiverId}`;
    const receivedmsgId = `${receiverId}and${currentUserId}`;
    
    loadChatMessages(msgId, userName, receiverId);

    if (messageInputArea) {
        messageInputArea.style.display = "flex";
    }

    if (messageDiv) {
        let userList = document.getElementById("selectedUsersList");

        if (!userList) {
            userList = document.createElement("ul");
            userList.id = "selectedUsersList";
            userList.style.listStyle = "none";
            userList.style.padding = "10px 0";
            userList.style.textAlign = "center";
            messageDiv.appendChild(userList);
        }

        const existingUser = [...userList.children].find(li => li.dataset.username === userName);
        if (!existingUser) {
            const userItem = document.createElement("li");
            userItem.dataset.username = userName;
            userItem.dataset.receiverid = receiverId;
            userItem.style.padding = "10px 0";
            userItem.style.color = "#007bff";
            userItem.style.cursor = "pointer";
            userItem.style.fontWeight = "500";
            userItem.style.transition = "background 0.3s ease-in-out";
            userItem.style.fontSize = "15px";
            userItem.style.position = "relative";
            userItem.style.display = "flex";
            userItem.style.flexDirection = "column";
            userItem.style.alignItems = "center";

            userItem.addEventListener("mouseenter", () => {
                userItem.style.backgroundColor = "#f0f0f0";
                userItem.style.borderRadius = "5px";
            });

            userItem.addEventListener("mouseleave", () => {
                userItem.style.backgroundColor = "transparent";
            });

            const userContent = document.createElement("div");
            userContent.style.display = "flex";
            userContent.style.alignItems = "center";
            userContent.style.gap = "10px";

            const userIcon = document.createElement("i");
            userIcon.className = "bx bx-user";
            userIcon.style.fontSize = "35px";
            userIcon.style.color = "#a8a8a9";

            const userNameSpan = document.createElement("span");
            userNameSpan.textContent = userName;

            userContent.appendChild(userIcon);
            userContent.appendChild(userNameSpan);

            const hr = document.createElement("div");
            hr.style.width = "80%";
            hr.style.height = "0.5px";
            hr.style.backgroundColor = "#ccc";
            hr.style.marginTop = "8px";
            hr.style.borderRadius = "2px";

            userItem.appendChild(userContent);
            userItem.appendChild(hr);

            userList.appendChild(userItem);

            userItem.addEventListener("click", () => {
                const receiverId = userItem.dataset.receiverid;
                console.log("User clicked:", userName, "Receiver ID:", receiverId);
                innerRightPanel.innerHTML = `
                    <h2>Chat with ${userName}</h2>
                    <div class="chat-bubble received">Hello ${userName}, how can I help you?</div>
                    <div class="chat-bubble">Hi ${userName}, let's start our conversation!</div>
                `;

                if (messageInputArea) {
                    messageInputArea.style.display = "flex";
                }

                window.receiverId = receiverId;
            });
        }
    }

    window.receiverId = receiverId;

    const newContent = document.getElementById("newComponent");
    if (newContent) {
        newContent.remove();
    }
}

function setupAutoRefresh() {
    refreshInterval = setInterval(() => {
        if (window.receiverId && currentUserId && !isTyping) {
            const chatHeader = document.querySelector("h2");
            const userName = chatHeader ? chatHeader.textContent.replace("Chat with ", "") : "Chat";
            loadChatMessages(`${currentUserId}and${window.receiverId}`, userName, window.receiverId);
        }
    }, 10000);
}

function loadChatMessages(msgId, userName, receiverId) {
    const innerRightPanel = document.getElementById("inner_right_panel");
    const receivedmsgId = `${receiverId}and${currentUserId}`;
    
    innerRightPanel.innerHTML = `
        <h2>Chat with ${userName}</h2>
        <div class="chat-messages">
            <div style="text-align: center; padding: 20px;">Loading messages...</div>
        </div>
    `;

    const getSentMessages = new Promise((resolve, reject) => {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if (xml.readyState === 4) {
                if (xml.status === 200) {
                    try {
                        var response = JSON.parse(xml.responseText);
                        resolve(response.data.messages || []);
                    } catch (e) {
                        console.error("Error parsing sent messages:", e);
                        resolve([]);
                    }
                }
            }
        };
        xml.onerror = () => reject("Error loading sent messages");
        xml.open("GET", `http://localhost/themisrepo/public/chat?msgid=${msgId}`, true);
        xml.send();
    });

    const getReceivedMessages = new Promise((resolve, reject) => {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if (xml.readyState === 4) {
                if (xml.status === 200) {
                    try {
                        var response = JSON.parse(xml.responseText);
                        resolve(response.data.messages || []);
                    } catch (e) {
                        console.error("Error parsing received messages:", e);
                        resolve([]);
                    }
                }
            }
        };
        xml.onerror = () => reject("Error loading received messages");
        xml.open("GET", `http://localhost/themisrepo/public/chat?msgid=${receivedmsgId}`, true);
        xml.send();
    });

    Promise.all([getSentMessages, getReceivedMessages])
        .then(([sentMessages, receivedMessages]) => {
            const allMessages = [...sentMessages, ...receivedMessages].sort((a, b) => 
                new Date(a.date) - new Date(b.date)
            );
            displayChatMessages(allMessages, userName, receiverId);
        })
        .catch(error => {
            console.error("Error loading messages:", error);
            innerRightPanel.innerHTML = `
                <h2>Chat with ${userName}</h2>
                <div class="chat-messages">
                    <div>Error loading messages. Please try again.</div>
                </div>
                ${getMessageInputHTML(receiverId)}
            `;
        });
}

function getMessageInputHTML(receiverId) {
    return `
        <div class="message-input">
            <label for="fileInput" class="file-upload">
                <span class="upload-icon">+</span>
            </label>
            <input type="file" id="message_file" style="display: none;">
            <input type="text" id="message_text" placeholder="Type your message..." />
            <button id="sendMessageBtn" onclick='send_message(event, "${receiverId}")'>Send</button>
        </div>
    `;
}

function displayChatMessages(messages, userName, receiverId) {
    const innerRightPanel = document.getElementById("inner_right_panel");
    let chatHTML = `<h2>Chat with ${userName}</h2><div class="chat-messages">`;

    if (messages && messages.length > 0) {
        messages.forEach(msg => {
            const isSender = msg.sender === currentUserId;
            chatHTML += `
                <div class="chat-bubble ${isSender ? '' : 'received'}" 
                     style="margin-${isSender ? 'left' : 'right'}: auto">
                    ${msg.message}
                    <small style="font-size: 0.8em; color: #888; display: block; margin-top: 5px;">
                        ${new Date(msg.date).toLocaleTimeString()}
                        ${isSender ? '(Sent)' : '(Received)'}
                    </small>
                </div>
            `;
        });
    } else {
        chatHTML += `<div style="text-align: center; padding: 20px;">No messages yet. Start a conversation!</div>`;
    }

    chatHTML += `</div>${getMessageInputHTML(receiverId)}`;
    innerRightPanel.innerHTML = chatHTML;

    const chatMessages = innerRightPanel.querySelector('.chat-messages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    const messageInput = document.getElementById('message_text');
    if (messageInput) {
        messageInput.addEventListener('input', function() {
            isTyping = this.value.length > 0;
        });
        
        messageInput.addEventListener('blur', function() {
            isTyping = false;
        });

        messageInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                send_message(event, receiverId);
            }
        });
    }
}

function send_message(e, receiverId) {
    var message_text = _("message_text");
    if (message_text.value.trim() == "") {
        alert("Please type something");
        return;
    }

    const msgId = `${currentUserId}and${receiverId}`;
    
    get_data({
        message: message_text.value.trim(),
        userid: currentUserId,
        receiverid: receiverId
    }, "send_message");

    message_text.value = "";
    isTyping = false;

    setTimeout(() => {
        loadChatMessages(msgId, document.querySelector("h2").textContent.replace("Chat with ", ""), receiverId);
    }, 100);
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