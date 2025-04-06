<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Calendar</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
</head>

<body>
    <?php include('/Applications/XAMPP/xamppfiles/htdocs/themisrepo/app/views/seniorCounsel/component/bigNav.view.php'); ?>
    <?php include('/Applications/XAMPP/xamppfiles/htdocs/themisrepo/app/views/seniorCounsel/component/smallNav1.view.php'); ?>
    <?php include('/Applications/XAMPP/xamppfiles/htdocs/themisrepo/app/views/seniorCounsel/component/sidebar.view.php'); ?>
    <div class="home-section">

        <div class="calendar-container">
            <div class="calendar-header">
                <h1>Calendar</h1>
                <a href="<?= ROOT ?>/calendar/addEvent" class="btn btn-add">
                    <i class="fas fa-plus"></i> Add New Event
                </a>
                <a href="<?= ROOT ?>/calendar/revokeAccess" class="btn btn-revoke" onclick="return confirm('Are you sure you want to revoke Google Calendar access? You will need to authorize again to use calendar features.');">
                    <i class="fas fa-unlink"></i> Revoke Calendar Access
                </a>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <div class="calendar-wrapper">
                <div id="calendar"></div>
            </div>

            <div class="upcoming-events">
                <h2>Upcoming Events</h2>
                <?php if (empty($events)): ?>
                    <p>No upcoming events found.</p>
                <?php else: ?>
                    <div class="events-list">
                        <?php foreach ($events as $event): ?>
                            <div class="event-card">
                                <div class="event-header">
                                    <h3><?= htmlspecialchars($event->getSummary()) ?></h3>
                                    <div class="event-actions">
                                        <a href="<?= ROOT ?>/calendar/editEvent/<?= $event->getId() ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="confirmDelete('<?= $event->getId() ?>')" class="btn-delete"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>

                                <?php
                                $start = $event->getStart()->dateTime;
                                if (empty($start)) {
                                    $start = $event->getStart()->date;
                                }

                                $end = $event->getEnd()->dateTime;
                                if (empty($end)) {
                                    $end = $event->getEnd()->date;
                                }

                                $start = new DateTime($start);
                                $end = new DateTime($end);
                                ?>

                                <div class="event-time">
                                    <i class="far fa-clock"></i>
                                    <?= $start->format('M d, Y g:i A') ?> - <?= $end->format('M d, Y g:i A') ?>
                                </div>

                                <?php if ($event->getLocation()): ?>
                                    <div class="event-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?= htmlspecialchars($event->getLocation()) ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($event->getDescription()): ?>
                                    <div class="event-description">
                                        <?= htmlspecialchars($event->getDescription()) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Event Modal -->
            <div id="event-modal" class="modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <h2>Add New Event</h2>
                    <form method="POST" action="<?= ROOT ?>/calendar/addEvent">
                        <div class="form-group">
                            <label for="summary">Event Title</label>
                            <input type="text" id="summary" name="summary" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="event-start-date">Start Date</label>
                                <input type="date" id="event-start-date" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" id="start_time" name="start_time" value="09:00" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="event-end-date">End Date</label>
                                <input type="date" id="event-end-date" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" id="end_time" name="end_time" value="10:00" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location">Location (Optional)</label>
                            <input type="text" id="location" name="location">
                        </div>

                        <div class="form-group">
                            <label for="description">Description (Optional)</label>
                            <textarea id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-save">Save Event</button>
                            <button type="button" class="btn btn-cancel" onclick="document.getElementById('event-modal').style.display='none'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: [
                        <?php foreach ($events as $event): ?> {
                                id: '<?= $event->getId() ?>',
                                title: '<?= addslashes($event->getSummary()) ?>',
                                start: '<?= $event->getStart()->dateTime ?: $event->getStart()->date ?>',
                                end: '<?= $event->getEnd()->dateTime ?: $event->getEnd()->date ?>',
                                url: '<?= ROOT ?>/calendar/editEvent/<?= $event->getId() ?>',
                                <?php if ($event->getColorId()): ?>
                                    backgroundColor: getColorForId('<?= $event->getColorId() ?>'),
                                <?php endif; ?>
                            },
                        <?php endforeach; ?>
                    ],
                    eventClick: function(info) {
                        if (info.event.url) {
                            info.jsEvent.preventDefault();
                            window.location.href = info.event.url;
                        }
                    },
                    // Add date click handler
                    dateClick: function(info) {
                        // Format the clicked date
                        const clickedDate = info.dateStr;

                        // Set the date in the form
                        document.getElementById('event-start-date').value = clickedDate;
                        document.getElementById('event-end-date').value = clickedDate;

                        // Show the modal
                        document.getElementById('event-modal').style.display = 'block';
                    },
                    // Allow event selection
                    selectable: true,
                    // Handle date range selection
                    select: function(info) {
                        // Format the selected dates
                        const startDate = info.startStr;
                        const endDate = info.endStr;

                        // Set the dates in the form
                        document.getElementById('event-start-date').value = startDate;
                        document.getElementById('event-end-date').value = endDate;

                        // Show the modal
                        document.getElementById('event-modal').style.display = 'block';
                    }
                });
                calendar.render();

                function getColorForId(colorId) {
                    // Google Calendar color IDs
                    const colors = {
                        '1': '#7986cb', // Lavender
                        '2': '#33b679', // Sage
                        '3': '#8e24aa', // Grape
                        '4': '#e67c73', // Flamingo
                        '5': '#f6c026', // Banana
                        '6': '#f5511d', // Tangerine
                        '7': '#039be5', // Peacock
                        '8': '#616161', // Graphite
                        '9': '#3f51b5', // Blueberry
                        '10': '#0b8043', // Basil
                        '11': '#d60000', // Tomato
                    };
                    return colors[colorId] || '#039be5'; // Default to Peacock
                }

                // Close modal when clicking the close button
                document.querySelector('.close-modal').addEventListener('click', function() {
                    document.getElementById('event-modal').style.display = 'none';
                });

                // Close modal when clicking outside of it
                window.addEventListener('click', function(event) {
                    if (event.target == document.getElementById('event-modal')) {
                        document.getElementById('event-modal').style.display = 'none';
                    }
                });
            });

            function confirmDelete(eventId) {
                if (confirm('Are you sure you want to delete this event?')) {
                    window.location.href = '<?= ROOT ?>/calendar/deleteEvent/' + eventId;
                }
            }
        </script>


</body>

</html>