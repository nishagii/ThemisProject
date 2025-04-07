<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS - Add Event</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/calendar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div class="form-container">
        <div class="form-header">
            <h1>Add New Event</h1>
        </div>

        <form method="POST" action="<?= ROOT ?>/calendar/addEvent">
            <div class="form-group">
                <label for="summary">Event Title</label>
                <input type="text" id="summary" name="summary" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>