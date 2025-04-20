document.addEventListener('DOMContentLoaded', function() {
    
    const notificationIcon = document.getElementById('notification-icon');
    const notificationDropdown = document.getElementById('notification-dropdown');
    const notificationCount = document.getElementById('notification-count');
    const notificationList = document.getElementById('notification-list');
    
    //notification dropdown
    notificationIcon.addEventListener('click', function() {
        notificationDropdown.classList.toggle('hidden');
        if (!notificationDropdown.classList.contains('hidden')) {
            loadNotifications();
        }
    });
    
    // Close notification dropdown when
    document.addEventListener('click', function(e) {
        if (!notificationIcon.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
    
    //load notifications
    function loadNotifications() {
        fetch(`${ROOT}/notificationController/getUnreadNotifications`)
            .then(response => response.json())
            .then(data => {
                renderNotifications(data);
                updateNotificationBadge(data.length);
            })
            .catch(error => console.error('Error loading notifications:', error));
    }
    
    //show notifications
    function renderNotifications(notifications) {
        notificationList.innerHTML = '';
        
        if (notifications.length === 0) {
            notificationList.innerHTML = '<div class="notification-item"><div class="notification-message">No new notifications</div></div>';
            return;
        }
        
        notifications.forEach(notification => {
            const notificationItem = document.createElement('div');
            notificationItem.className = 'notification-item unread';
            notificationItem.dataset.id = notification.id;
            
            const message = document.createElement('div');
            message.className = 'notification-message';
            message.textContent = notification.message;
            
            const time = document.createElement('div');
            time.className = 'notification-time';
            time.textContent = formatTime(notification.timestamp);
            
            notificationItem.appendChild(message);
            notificationItem.appendChild(time);
            
            //mark notification as read
            notificationItem.addEventListener('click', function() {
                markAsRead(notification.id);
                notificationItem.classList.remove('unread');
            });
            
            notificationList.appendChild(notificationItem);
        });
    }
    
    //mark notification as read
    function markAsRead(id) {
        fetch(`${ROOT}/notificationController/markAsRead/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // notification count
                    const currentCount = parseInt(notificationCount.textContent);
                    if (currentCount > 0) {
                        updateNotificationBadge(currentCount - 1);
                    }
                }
            })
            .catch(error => console.error('Error marking notification as read:', error));
    }
    
    // update notification badge (red colour)
    function updateNotificationBadge(count) {
        if (count > 0) {
            notificationCount.textContent = count;
            notificationCount.style.display = 'block';
        } else {
            notificationCount.style.display = 'none';
        }
    }
    
    //timestamp
    function formatTime(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleString();
    }
    
    //  load notifications on page loading
    loadNotifications();
    
    // Check for new notifications every 30 seconds
    setInterval(loadNotifications, 30000);
});