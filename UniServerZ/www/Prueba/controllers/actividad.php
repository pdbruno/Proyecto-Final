<?php
class actividad extends Controller {

  function __construct() {
    parent::__construct();
    session_start();
  }

  function actividades() {
    $this->manejar("actividades");
    $this->view->render('actividades/index');
  }

  public function tomarlista() {
    $this->manejar("tomarlista");
    $this->view->render('tomarlista/index');
  }

  function traerEventos() {
    $data = $_POST['data'];
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    echo $this->model->traerEventos($data, $service);
  }
  public function asignarAsistencia()
  {
    $data = json_decode($_POST['data'], TRUE);
    $id = trim($_POST['data2']);
    $service = $this->getService();
    echo $this->model->asignarAsistencia($data,$id, $service);
  }
  public  function traerAnotados() {
    $data = json_decode($data, TRUE);
    $service = $this->getService();
    echo $this->model->traerAnotados($data, $service);
  }

  public function traerActividades() {
    echo $this->model->traerActividades();
  }

  public function mostrar()
  {
    echo $this->model->mostrar($idActividades, $service);
  }
  private function getService() {
    $client = new Google_Client();
    $client->setAccessType("offline");
    $google_token= $_SESSION['access_token'];
    $client->setAccessToken($google_token);
    $service = new Google_Service_Calendar($client);
    return $service;
  }
  public function editarActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    echo $this->model->editarEvento($evento, $actividad["idActividades"], $service);
  }
  public function addActividad() {
    $actividad = json_decode($_POST['data1'], TRUE);
    $evento = $this->model->format($actividad);
    $service = $this->getService();
    $this->model->agregarEvento($evento, $service);
  }

  public function manejar($pagina)
  {
    $_SESSION['page'] = $pagina;
    $client = new Google_Client();
    $client->setAccessType("offline");
    $client->setAuthConfig('client_secrets.json');
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $google_token= $_SESSION['access_token'];
      $client->refreshToken($google_token);
      $_SESSION['access_token']= $client->getAccessToken();
    } else {
      $redirect_uri = URL . 'actividad/calendar/' . $pagina;
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }
  public function calendar() {
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
      $redirect_uri = URL . 'actividad/' . $_SESSION['page'];
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }


}
