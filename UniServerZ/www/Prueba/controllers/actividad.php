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
  public function mostrar()
  {
    if (isset($_POST['data'])) {
        $idActividades = $_POST['data'];
    } else {
        require 'controllers/error_.php';
        $error = new Error_();
        $error->index("Hubo un error en la transferencia de datos");
    }
    echo $this->model->mostrar($idActividades);
  }
  public function manejar()
  {
    session_start();

    $client = new Google_Client();
    $client->setAuthConfig('client_secrets.json');
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $google_token= $_SESSION['access_token'];
      $client->refreshToken($google_token);
      $_SESSION['access_token']= $client->getAccessToken();
      $service = new Google_Service_Calendar($client);
      $this->model->setServicio($service);
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
    $client->addScope('https://www.googleapis.com/auth/calendar');
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
