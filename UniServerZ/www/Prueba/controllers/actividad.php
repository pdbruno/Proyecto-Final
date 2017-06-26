<?php
class actividad extends Controller {

  function __construct() {
    parent::__construct();
  }
  function index() {
    $this->view->render('agregaractividad/index');
  }
  public function traerActividades() {
    $datos = $this->model->traerActividades();
    echo $datos;
  }
  public function manejar()
  {
    session_start();

    $client = new Google_Client();
    $client->setAuthConfig('client_secrets.json');
    $client->addScope(Google_Service_Calendar::CALENDAR);

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
      $service = new Google_Service_Calendar($client);

      $calendarId = 'primary';
      $optParams = array(
        'maxResults' => 10,
        'orderBy' => 'startTime',
        'singleEvents' => TRUE,
        'timeMin' => date('c'),
      );
      $results = $service->events->listEvents($calendarId, $optParams);
      var_dump($results);
    } else {
      $redirect_uri = URL . 'actividad/calendar';
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }
  public function calendar() {
    session_start();

    $client = new Google_Client();
    $client->setAuthConfigFile('client_secrets.json');
    $client->setRedirectUri(URL . 'actividad/calendar');
    $client->setAccessType("offline");
    $client->setIncludeGrantedScopes(true);
    $client->addScope(Google_Service_Calendar::CALENDAR);
    if (! isset($_GET['code'])) {
      $auth_url = $client->createAuthUrl();
      header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    } else {
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      $redirect_uri = URL . 'actividad/manejar';
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }


}
