<?php
class calendar extends Controller {

  function __construct() {
    parent::__construct();
    session_start();
  }
  protected function miCatch($e)
  {
    $error = json_decode($e->getMessage())->error->code;
    if ($error == 401) {
      $url = isset($_GET['url']) ? $_GET['url'] : null;
      $url = rtrim($url, '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      $redirect_uri = URL . 'calendar/manejar/' . $url[0] . '/' . $url[1];
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }elseif ($error == 404) {
      echo "Not Found";
    }
  }
  protected function getService() {
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client = new Google_Client();
      $google_token= $_SESSION['access_token'];
      $client->setAccessToken($google_token);
      $service = new Google_Service_Calendar($client);
      return $service;
    } else {
      $url = isset($_GET['url']) ? $_GET['url'] : null;
      $url = rtrim($url, '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      $redirect_uri = URL . 'calendar/manejar/' . $url[0] . '/' . $url[1];
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }

  }

  public function manejar($controller, $pagina)
  {
    $_SESSION['page'] = $pagina;
    $_SESSION['controller'] = $controller;
    $client = new Google_Client();
    $client->setAccessType("offline");
    $client->setAuthConfig('client_secrets.json');
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $google_token= $_SESSION['access_token'];
      $client->refreshToken($google_token);
      $_SESSION['access_token']= $client->getAccessToken();
    } else {
      $redirect_uri = URL . 'calendar/calendar/';
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }
  public function calendar() {
    $client = new Google_Client();
    $client->setAuthConfigFile('client_secrets.json');
    $client->setRedirectUri(URL . 'calendar/calendar');
    $client->setAccessType("offline");
    $client->setIncludeGrantedScopes(true);
    $client->addScope('https://www.googleapis.com/auth/calendar');
    if (! isset($_GET['code'])) {
      $auth_url = $client->createAuthUrl();
      header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    } else {
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      $redirect_uri = URL . $_SESSION['controller'] .'/'. $_SESSION['page'];
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }


}
