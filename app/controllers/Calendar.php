<?php

class Calendar
{
    use Controller;

    private $client;
    private $service;

    public function __construct()
    {
       
        require_once __DIR__ . '/../../vendor/autoload.php';

    
        $basePath = realpath(__DIR__ . '/../../');

       
        $credentialsPath = $basePath . '/credentials.json';
        $tokenPath = $basePath . '/token.json';

        $this->client = new Google_Client();
        $this->client->setApplicationName('Themis Calendar Integration');
        $this->client->setScopes(\Google\Service\Calendar::CALENDAR);
        $this->client->setAuthConfig($credentialsPath);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $this->client->setRedirectUri('http://localhost/themisrepo/public/calendar/auth'); 


        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }
        if (!file_exists($tokenPath)) {
            error_log('Token file does not exist: ' . $tokenPath);
        } else {
            error_log('Token file found: ' . $tokenPath);
        }

      
        if ($this->client->isAccessTokenExpired()) {
           
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());

                
                if ($this->client->getAccessToken()) {
                    file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
                }
            } else {
               
                $currentMethod = isset($_GET['url']) ? explode('/', $_GET['url']) : [];
                if (!(isset($currentMethod[1]) && $currentMethod[1] === 'auth')) {
                 
                    $authUrl = $this->client->createAuthUrl();
                    $_SESSION['authUrl'] = $authUrl;
                }
            }
        }


        if ($this->client->getAccessToken() && !$this->client->isAccessTokenExpired()) {
            $this->service = new \Google\Service\Calendar($this->client);
        }
    }

    public function index()
    {

        if (!$this->client->getAccessToken() || $this->client->isAccessTokenExpired()) {
            if (isset($_SESSION['authUrl'])) {
                error_log('Redirecting to auth URL: ' . $_SESSION['authUrl']);
                redirect($_SESSION['authUrl']);
                exit; 
            } else {
                error_log('No auth URL found, showing auth error view.');
                $this->view('/calendar/calendar_auth_error');
                return;
            }
        }

     
        $events = $this->getEvents();

        
        $this->view('/calendar/calendar', ['events' => $events]);
    }

    public function auth()
    {
        if (isset($_GET['code'])) {
            try {
            
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);

               
                if (isset($accessToken['error'])) {
                 
                    error_log('Error fetching access token: ' . $accessToken['error_description']);
                    $this->view('/calendar/calendar_auth_error');
                    return;
                }

             
                $basePath = realpath(__DIR__ . '/../../');
                $tokenPath = $basePath . '/token.json';

                if (!file_put_contents($tokenPath, json_encode($accessToken))) {
               
                    error_log('Failed to save token to: ' . $tokenPath);
                    $this->view('/calendar/calendar_auth_error');
                    return;
                }

               
                $this->client->setAccessToken($accessToken);

          
                $this->service = new \Google\Service\Calendar($this->client);

                
                if (isset($_SESSION['authUrl'])) {
                    unset($_SESSION['authUrl']);
                }

            
                redirect('calendar');
                exit; 
            } catch (Exception $e) {
               
                error_log('Exception during auth: ' . $e->getMessage());
                $this->view('/calendar/calendar_auth_error');
                return;
            }
        } else {
          
            if (isset($_SESSION['authUrl'])) {
                redirect($_SESSION['authUrl']);
                exit; 
            } else {
                $this->view('/calendar/calendar_auth_error');
            }
        }
    }

    private function getEvents($maxResults = 10)
    {

        if (!isset($this->service)) {
            return [];
        }

        try {
         
            $calendarId = 'primary';
            $optParams = [
                'maxResults' => $maxResults,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'), 
            ];

            $results = $this->service->events->listEvents($calendarId, $optParams);
            return $results->getItems();
        } catch (Exception $e) {
        
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
                    'timeZone' => 'Asia/Kolkata', 
                ],
                'end' => [
                    'dateTime' => $_POST['end_date'] . 'T' . $_POST['end_time'] . ':00',
                    'timeZone' => 'Asia/Kolkata', 
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
            
            $event = $this->service->events->get($calendarId, $eventId);

         
            $event->setSummary($_POST['summary'] ?? 'Updated Event');
            $event->setLocation($_POST['location'] ?? '');
            $event->setDescription($_POST['description'] ?? '');

            $start = new \Google\Service\Calendar\EventDateTime();
            $start->setDateTime($_POST['start_date'] . 'T' . $_POST['start_time'] . ':00');
            $start->setTimeZone('Asia/Kolkata');
            $event->setStart($start);

            $end = new \Google\Service\Calendar\EventDateTime();
            $end->setDateTime($_POST['end_date'] . 'T' . $_POST['end_time'] . ':00');
            $end->setTimeZone('Asia/Kolkata'); 
            $event->setEnd($end);

            $updatedEvent = $this->service->events->update($calendarId, $event->getId(), $event);

            $_SESSION['success'] = 'Event updated successfully!';
            redirect('calendar');
        } else {
            
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
      
        $basePath = realpath(__DIR__ . '/../../');
        $tokenPath = $basePath . '/token.json';

      
        if ($this->client && $this->client->getAccessToken()) {
            try {
             
                $this->client->revokeToken();

               
                if (file_exists($tokenPath)) {
                    unlink($tokenPath);
                }

                
                if (isset($_SESSION['authUrl'])) {
                    unset($_SESSION['authUrl']);
                }

               
                $_SESSION['success'] = 'Google Calendar access successfully revoked.';
            } catch (Exception $e) {
              
                error_log('Exception revoking access: ' . $e->getMessage());
                $_SESSION['error'] = 'Failed to revoke access: ' . $e->getMessage();
            }
        } else {
            $_SESSION['info'] = 'No active Google Calendar connection to revoke.';
        }

     
        redirect('calendar/noAccess');
        exit;
    }

   
    public function noAccess()
    {
    
        $authUrl = $this->client->createAuthUrl();
        $_SESSION['authUrl'] = $authUrl;

       
        $this->view('/calendar/no_calendar_access', ['authUrl' => $authUrl]);
    }
}
