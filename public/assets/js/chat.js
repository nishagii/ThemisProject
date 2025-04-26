// Global variables
let currentUserId = userId;
let isTyping = false;
let refreshInterval;
let lastMessageTimestamp = null; // Track the last message timestamp

// Add loading spinner and refresh indicator CSS
const styleElement = document.createElement('style');
styleElement.textContent = `
  .spinner {
    width: 40px;
    height: 40px;
    margin: 20px auto;
    border: 3px solid rgba(0, 123, 255, 0.3);
    border-radius: 50%;
    border-top-color: #007bff;
    animation: spin 1s ease-in-out infinite;
  }
  
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  
  .mini-spinner {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-left: 5px;
    border: 2px solid rgba(0, 123, 255, 0.3);
    border-radius: 50%;
    border-top-color: #007bff;
    animation: spin 1s ease-in-out infinite;
  }
  
  .refresh-indicator {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 15px;
    height: 15px;
    border: 2px solid rgba(0, 123, 255, 0.3);
    border-radius: 50%;
    border-top-color: #007bff;
    animation: spin 1s ease-in-out infinite;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
  }
  
  .refresh-active {
    opacity: 1;
  }
  
  .new-messages-indicator {
    background-color: rgba(0, 123, 255, 0.1);
    color: #007bff;
    text-align: center;
    padding: 5px;
    margin: 5px 0;
    border-radius: 5px;
    animation: fadeOut 3s forwards;
  }
  
  @keyframes fadeOut {
    0% { opacity: 1; }
    70% { opacity: 1; }
    100% { opacity: 0; }
  }
  
  .message-status {
    font-size: 0.8em;
    color: #888;
    display: block;
    margin-top: 5px;
  }
  
  .chat-bubble {
    transition: opacity 0.3s ease-out;
  }
  
  @keyframes highlight {
    0% { background-color: rgba(0, 123, 255, 0.1); }
    100% { background-color: transparent; }
  }
`;
document.head.appendChild(styleElement);

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
    
    // Reset the lastMessageTimestamp when starting a new chat
    lastMessageTimestamp = null;
    
    // Show loading spinner immediately
    innerRightPanel.innerHTML = `
        <h2>Chat with ${userName}</h2>
        <div class="chat-messages">
            <div style="text-align: center; padding: 20px;">
                <div class="spinner"></div>
                <p>Loading conversation...</p>
            </div>
        </div>
    `;
    
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
                
                // Reset the lastMessageTimestamp when switching users
                lastMessageTimestamp = null;
                
                // Show loading spinner immediately when switching chats
                innerRightPanel.innerHTML = `
                    <h2>Chat with ${userName}</h2>
                    <div class="chat-messages">
                        <div style="text-align: center; padding: 20px;">
                            <div class="spinner"></div>
                            <p>Loading conversation...</p>
                        </div>
                    </div>
                `;
                
                loadChatMessages(`${currentUserId}and${receiverId}`, userName, receiverId);
                
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

// Updated setupAutoRefresh function with visible indicator
function setupAutoRefresh() {
    refreshInterval = setInterval(() => {
        if (window.receiverId && currentUserId && !isTyping) {
            // Get or create refresh indicator
            let refreshIndicator = document.querySelector('.refresh-indicator');
            const innerRightPanel = document.getElementById('inner_right_panel');
            
            if (!refreshIndicator && innerRightPanel) {
                innerRightPanel.style.position = 'relative';
                refreshIndicator = document.createElement('div');
                refreshIndicator.className = 'refresh-indicator';
                innerRightPanel.appendChild(refreshIndicator);
            }
            
            // Show the loading indicator when refreshing
            if (refreshIndicator) {
                refreshIndicator.classList.add('refresh-active');
            }
            
            // Fetch new messages
            fetchNewMessages(window.receiverId)
                .finally(() => {
                    // Hide the indicator when done
                    if (refreshIndicator) {
                        setTimeout(() => {
                            refreshIndicator.classList.remove('refresh-active');
                        }, 500);
                    }
                });
        }
    }, 5000); // Refresh every 5 seconds
}

// Modified fetchNewMessages to return a Promise
function fetchNewMessages(receiverId) {
    const msgId = `${currentUserId}and${receiverId}`;
    const receivedmsgId = `${receiverId}and${currentUserId}`;
    
    // Create promises for getting new sent and received messages
    const getNewSentMessages = new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        resolve(response.data.messages || []);
                    } catch (e) {
                        console.error("Error parsing sent messages:", e);
                        resolve([]);
                    }
                }
            }
        };
        xhr.onerror = () => reject("Error loading sent messages");
        
        // Add a timestamp parameter to get only new messages
        let url = `http://localhost/themisrepo/public/chat?msgid=${msgId}`;
        if (lastMessageTimestamp) {
            url += `&after=${lastMessageTimestamp}`;
        }
        
        xhr.open("GET", url, true);
        xhr.send();
    });

    const getNewReceivedMessages = new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        resolve(response.data.messages || []);
                    } catch (e) {
                        console.error("Error parsing received messages:", e);
                        resolve([]);
                    }
                }
            }
        };
        xhr.onerror = () => reject("Error loading received messages");
        
        // Add a timestamp parameter to get only new messages
        let url = `http://localhost/themisrepo/public/chat?msgid=${receivedmsgId}`;
        if (lastMessageTimestamp) {
            url += `&after=${lastMessageTimestamp}`;
        }
        
        xhr.open("GET", url, true);
        xhr.send();
    });

    return new Promise((resolve, reject) => {
        Promise.all([getNewSentMessages, getNewReceivedMessages])
            .then(([newSentMessages, newReceivedMessages]) => {
                const newMessages = [...newSentMessages, ...newReceivedMessages].sort((a, b) => 
                    new Date(a.date) - new Date(b.date)
                );
                
                if (newMessages.length > 0) {
                    // Update lastMessageTimestamp to the most recent message
                    const mostRecentMessage = newMessages[newMessages.length - 1];
                    lastMessageTimestamp = new Date(mostRecentMessage.date).toISOString();
                    
                    // Show new messages notification if messages were received (not sent by current user)
                    const receivedMessages = newMessages.filter(msg => msg.sender !== currentUserId);
                    if (receivedMessages.length > 0) {
                        showNewMessagesNotification(receivedMessages.length);
                    }
                    
                    // Append only the new messages to the chat
                    appendNewMessages(newMessages);
                }
                
                resolve(newMessages);
            })
            .catch(error => {
                console.error("Error fetching new messages:", error);
                reject(error);
            });
    });
}

// New function to show notification when new messages arrive
function showNewMessagesNotification(count) {
    const chatMessages = document.querySelector('.chat-messages');
    if (!chatMessages) return;
    
    const notification = document.createElement('div');
    notification.className = 'new-messages-indicator';
    notification.textContent = `${count} new message${count > 1 ? 's' : ''}`;
    
    chatMessages.appendChild(notification);
    
    // Auto-remove notification after animation completes
    setTimeout(() => {
        if (notification && notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// Updated appendNewMessages function with indicators for new messages
function appendNewMessages(newMessages) {
    const chatMessages = document.querySelector('.chat-messages');
    if (!chatMessages) return;
    
    // Update any "sending" messages to "sent" if they exist
    const pendingMessages = chatMessages.querySelectorAll('.chat-bubble[data-status="sending"]');
    pendingMessages.forEach(msg => {
        msg.dataset.status = "sent";
        const statusElement = msg.querySelector('.message-status');
        if (statusElement) {
            statusElement.innerHTML = `${new Date().toLocaleTimeString()} (Sent)`;
        }
        msg.style.opacity = '1';
    });
    
    newMessages.forEach(msg => {
        const isSender = msg.sender === currentUserId;
        const messageElement = document.createElement('div');
        messageElement.className = `chat-bubble ${isSender ? '' : 'received'}`;
        messageElement.style.marginLeft = isSender ? 'auto' : '0';
        messageElement.style.marginRight = isSender ? '0' : 'auto';
        
        // Add a highlight effect for new received messages
        if (!isSender) {
            messageElement.style.animation = 'highlight 2s ease-out';
        }
        
        messageElement.innerHTML = `
            ${msg.message}
            <span class="message-status">
                ${new Date(msg.date).toLocaleTimeString()}
                ${isSender ? '(Sent)' : '(Received)'}
            </span>
        `;
        
        // Add a subtle fade-in animation
        messageElement.style.opacity = '0';
        messageElement.style.transition = 'opacity 0.3s ease-in-out';
        
        chatMessages.appendChild(messageElement);
        
        // Trigger reflow and apply the animation
        setTimeout(() => {
            messageElement.style.opacity = '1';
        }, 50);
    });
    
    // Scroll to the bottom of the chat only if there are new received messages
    if (newMessages.some(msg => msg.sender !== currentUserId)) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}

// Modified loadChatMessages to set the initial lastMessageTimestamp
function loadChatMessages(msgId, userName, receiverId) {
    const innerRightPanel = document.getElementById("inner_right_panel");
    const receivedmsgId = `${receiverId}and${currentUserId}`;
    
    // Loading spinner already displayed in start_chat

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
            
            // Set the lastMessageTimestamp to the most recent message
            if (allMessages.length > 0) {
                const mostRecentMessage = allMessages[allMessages.length - 1];
                lastMessageTimestamp = new Date(mostRecentMessage.date).toISOString();
            }
            
            displayChatMessages(allMessages, userName, receiverId);
            
            // Create refresh indicator after loading messages
            const refreshIndicator = document.createElement('div');
            refreshIndicator.className = 'refresh-indicator';
            innerRightPanel.appendChild(refreshIndicator);
        })
        .catch(error => {
            console.error("Error loading messages:", error);
            innerRightPanel.innerHTML = `
                <h2>Chat with ${userName}</h2>
                <div class="chat-messages">
                    <div style="text-align: center; padding: 20px;">
                        <i class='bx bx-error-circle' style="font-size: 40px; color: #dc3545;"></i>
                        <p>Error loading messages. Please try again.</p>
                    </div>
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
                    <span class="message-status">
                        ${new Date(msg.date).toLocaleTimeString()}
                        ${isSender ? '(Sent)' : '(Received)'}
                    </span>
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

// Modified send_message to update without reloading all messages
function send_message(e, receiverId) {
    var message_text = _("message_text");
    if (message_text.value.trim() == "") {
        alert("Please type something");
        return;
    }

    const messageContent = message_text.value.trim();
    
    // Create a temporary message element immediately
    const chatMessages = document.querySelector('.chat-messages');
    if (chatMessages) {
        const tempMessage = document.createElement('div');
        tempMessage.className = 'chat-bubble';
        tempMessage.dataset.status = "sending";
        tempMessage.style.marginLeft = 'auto';
        tempMessage.style.opacity = '0.7'; // Slightly transparent to indicate pending
        
        tempMessage.innerHTML = `
            ${messageContent}
            <span class="message-status">
                ${new Date().toLocaleTimeString()}
                (Sending<span class="mini-spinner"></span>)
            </span>
        `;
        
        chatMessages.appendChild(tempMessage);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Send the message to the server
    get_data({
        message: messageContent,
        userid: currentUserId,
        receiverid: receiverId
    }, "send_message");

    message_text.value = "";
    isTyping = false;

    // Instead of reloading all messages, just fetch new messages after a short delay
    setTimeout(() => {
        fetchNewMessages(receiverId);
    }, 5000);
}