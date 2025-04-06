<?php

class Calendar
{
    use Controller;

    private $client;
    private $service;

    public function __construct()
    {
        // Initialize Google API client
        require_once __DIR__ . '/../../vendor/autoload.php';

        $this->client = new Google_Client();
        $this->client->setApplicationName('Themis Calendar Integration');
        $this->client->setScopes(\Google\Service\Calendar::CALENDAR);
        $this->client->setAuthConfig('/Applications/XAMPP/xamppfiles/htdocs/themisrepo/credentials.json'); // Use absolute path
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $this->client->setRedirectUri('http://localhost/themisrepo/public/calendar/auth'); // Explicitly set redirect URI

      

        // Load previously authorized token from a file, if it exists
        $tokenPath = '/Applications/XAMPP/xamppfiles/htdocs/themisrepo/token.json'; // Use absolute path
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }
        if (!file_exists($tokenPath)) {
            error_log('Token file does not exist: ' . $tokenPath);
        } else {
            error_log('Token file found: ' . $tokenPath);
        }

        // If there is no previous token or it's expired
        if ($this->client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());

                // Save the refreshed token
                if ($this->client->getAccessToken()) {
                    file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
                }
            } else {
                // Only redirect to auth URL if we're not already in the auth method
                $currentMethod = isset($_GET['url']) ? explode('/', $_GET['url']) : [];
                if (!(isset($currentMethod[1]) && $currentMethod[1] === 'auth')) {
                    // Request authorization from the user
                    $authUrl = $this->client->createAuthUrl();
                    $_SESSION['authUrl'] = $authUrl;
                }
            }
        }

        // Initialize the service if we have a valid token
        if ($this->client->getAccessToken() && !$this->client->isAccessTokenExpired()) {
            $this->service = new \Google\Service\Calendar($this->client);
        }
    }

    public function index()
    {
        // Check if we have a valid access token
        if (!$this->client->getAccessToken() || $this->client->isAccessTokenExpired()) {
            if (isset($_SESSION['authUrl'])) {
                error_log('Redirecting to auth URL: ' . $_SESSION['authUrl']);
                redirect($_SESSION['authUrl']);
                exit; // Make sure to exit after redirect
            } else {
                error_log('No auth URL found, showing auth error view.');
                $this->view('/calendar/calendar_auth_error');
                return;
            }
        }

        // Get upcoming events
        $events = $this->getEvents();

        // Load the calendar view
        $this->view('/calendar/calendar', ['events' => $events]);
    }

    public function auth()
    {
        if (isset($_GET['code'])) {
            try {
                // Exchange authorization code for an access token
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);

                // Check for errors in the access token
                if (isset($accessToken['error'])) {
                    // Log the error
                    error_log('Error fetching access token: ' . $accessToken['error_description']);
                    $this->view('/calendar/calendar_auth_error');
                    return;
                }

                // Store the access token
                $tokenPath = '/Applications/XAMPP/xamppfiles/htdocs/themisrepo/token.json'; // Use absolute path
                if (!file_put_contents($tokenPath, json_encode($accessToken))) {
                    // Log the error if we couldn't save the token
                    error_log('Failed to save token to: ' . $tokenPath);
                    $this->view('/calendar/calendar_auth_error');
                    return;
                }

                // Set the access token on the client
                $this->client->setAccessToken($accessToken);

                // Initialize the service
                $this->service = new \Google\Service\Calendar($this->client);

                // Clear the auth URL from session to prevent redirect loops
                if (isset($_SESSION['authUrl'])) {
                    unset($_SESSION['authUrl']);
                }

                // Redirect to calendar page
                redirect('calendar');
                exit; // Make sure to exit after redirect
            } catch (Exception $e) {
                // Log any exceptions
                error_log('Exception during auth: ' . $e->getMessage());
                $this->view('/calendar/calendar_auth_error');
                return;
            }
        } else {
            // If no code is present, redirect to the auth URL
            if (isset($_SESSION['authUrl'])) {
                redirect($_SESSION['authUrl']);
                exit; // Make sure to exit after redirect
            } else {
                $this->view('/calendar/calendar_auth_error');
            }
        }
    }

    private function getEvents($maxResults = 10)
    {
        // Make sure we have a valid service
        if (!isset($this->service)) {
            return [];
        }

        try {
            // Get the user's primary calendar events
            $calendarId = 'primary';
            $optParams = [
                'maxResults' => $maxResults,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'), // Get only upcoming events
            ];

            $results = $this->service->events->listEvents($calendarId, $optParams);
            return $results->getItems();
        } catch (Exception $e) {
            // Log any exceptions
            error_log('Exception getting events: ' . $e->getMessage());
            return [];
        }
    }

    public function addEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = new \Google\Service\Calendar\Event([
                'summary' => $_POST['summary'] ?? 'New Event',
                'location' => $_POST['location'] ?? '',
                'description' => $_POST['description'] ?? '',
                'start' => [
                    'dateTime' => $_POST['start_date'] . 'T' . $_POST['start_time'] . ':00',
                    'timeZone' => 'Asia/Kolkata', // Adjust for your timezone
                ],
                'end' => [
                    'dateTime' => $_POST['end_date'] . 'T' . $_POST['end_time'] . ':00',
                    'timeZone' => 'Asia/Kolkata', // Adjust for your timezone
                ],
                'reminders' => [
                    'useDefault' => true,
                ],
            ]);

            $calendarId = 'primary';
            $event = $this->service->events->insert($calendarId, $event);

            $_SESSION['success'] = 'Event added successfully!';
            redirect('calendar');
        } else {
            $this->view('/calendar/add_event');
        }
    }

    public function editEvent($eventId)
    {
        $calendarId = 'primary';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the event first
            $event = $this->service->events->get($calendarId, $eventId);

            // Update event properties
            $event->setSummary($_POST['summary'] ?? 'Updated Event');
            $event->setLocation($_POST['location'] ?? '');
            $event->setDescription($_POST['description'] ?? '');

            $start = new \Google\Service\Calendar\EventDateTime();
            $start->setDateTime($_POST['start_date'] . 'T' . $_POST['start_time'] . ':00');
            $start->setTimeZone('Asia/Kolkata'); // Adjust for your timezone
            $event->setStart($start);

            $end = new \Google\Service\Calendar\EventDateTime();
            $end->setDateTime($_POST['end_date'] . 'T' . $_POST['end_time'] . ':00');
            $end->setTimeZone('Asia/Kolkata'); // Adjust for your timezone
            $event->setEnd($end);

            $updatedEvent = $this->service->events->update($calendarId, $event->getId(), $event);

            $_SESSION['success'] = 'Event updated successfully!';
            redirect('calendar');
        } else {
            // Get the event to edit
            $event = $this->service->events->get($calendarId, $eventId);
            $this->view('/calendar/edit_event', ['event' => $event]);
        }
    }

    public function deleteEvent($eventId)
    {
        $calendarId = 'primary';
        $this->service->events->delete($calendarId, $eventId);

        $_SESSION['success'] = 'Event deleted successfully!';
        redirect('calendar');
    }

    public function revokeAccess()
    {
        // Path to the token file
        $tokenPath = '/Applications/XAMPP/xamppfiles/htdocs/themisrepo/token.json';

        // Check if we have a valid client and access token
        if ($this->client && $this->client->getAccessToken()) {
            try {
                // Revoke the token
                $this->client->revokeToken();

                // Delete the token file if it exists
                if (file_exists($tokenPath)) {
                    unlink($tokenPath);
                }

                // Clear any session data related to Google auth
                if (isset($_SESSION['authUrl'])) {
                    unset($_SESSION['authUrl']);
                }

                // Set success message
                $_SESSION['success'] = 'Google Calendar access successfully revoked.';
            } catch (Exception $e) {
                // Log any exceptions
                error_log('Exception revoking access: ' . $e->getMessage());
                $_SESSION['error'] = 'Failed to revoke access: ' . $e->getMessage();
            }
        } else {
            $_SESSION['info'] = 'No active Google Calendar connection to revoke.';
        }

        // Redirect back to calendar page
        redirect('calendar');
        exit;
    }
}
