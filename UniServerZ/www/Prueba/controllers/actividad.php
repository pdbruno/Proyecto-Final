<?php
class actividad extends Controller {

  function __construct() {
    parent::__construct();
    session_start();
  }

  function agregaractividad() {
    $this->view->render('agregaractividad/index');
  }

  public function tomarlista() {
    $this->view->render('tomarlista/index');
  }

  function traerEventos() {
    if (isset($_POST['data'])) {
      $data = $_POST['data'];
    } else {
      require 'controllers/error_.php';
      $error = new Error_();
      $error->index("Hubo un error en la transferencia de datos");
    }
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    echo $this->model->traerEventos($data, $service);
  }

  function traerAnotados() {
    if (isset($_POST['data'])) {
      $data = $_POST['data'];
    } else {
      require 'controllers/error_.php';
      $error = new Error_();
      $error->index("Hubo un error en la transferencia de datos");
    }
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    echo $this->model->traerAnotados($data, $service);
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
      $service = $this->getService();
      echo $this->model->mostrar($idActividades, $service);
  }
  public function getService() {
    $client = new Google_Client();
    $google_token= $_SESSION['access_token'];
    $client->setAccessToken($google_token);
    $service = new Google_Service_Calendar($client);
    return $service;
  }
  public function editarActividad() {
    $actividad= $this->getActividad();
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    echo $this->model->editarEvento($evento, $actividad["idActividades"], $service);
  }
  public function addActividad() {
    $actividad=$this->getActividad();
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    $this->model->agregarEvento($evento, $service);
  }
  public function getActividad(){
    if (isset($_POST['data1'])) {
      $data1 = $_POST['data1'];
    } else {
      require 'controllers/error_.php';
      $error = new Error_();
      $error->index("Hubo un error en la transferencia de datos");
    }
    $actividad = json_decode($data1, TRUE);
    return $actividad;
  }

  public function manejar($pagina=false)
  {
    $client = new Google_Client();
    $client->setAuthConfig('client_secrets.json');
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $google_token= $_SESSION['access_token'];
      $client->refreshToken($google_token);
      $_SESSION['access_token']= $client->getAccessToken();
      $redirect_uri = URL . 'actividad/' . $pagina;
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    } else {
      $redirect_uri = URL . 'actividad/calendar/' . $pagina;
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }
  public function calendar($pagina = false) {
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
      $redirect_uri = URL . 'actividad/manejar/' . $pagina;
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }


}
