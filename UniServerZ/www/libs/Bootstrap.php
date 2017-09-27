<?php

class Bootstrap {

  private $_url = null;
  private $_controller = null;

  function __construct() {
    $this->_getUrl();
    if (empty($this->_url[0])) {
      $this->_loadDefaultController();
      exit;
    }
    $this->_loadExistingController();
    $this->_callControllerMethod();
  }

  private function _callControllerMethod()
  {
    if( count( $this->_url ) >= 2 )
    {
      if( !method_exists( $this->_controller, $this->_url[1] ) )
      {
        $this->_error();
      }
      $params = $this->_url;
      unset( $params[0] ); // removing controller
      unset( $params[1] ); // removing method
      array($this->_controller, $this->_url[1])(...$params);
    }else{
      $this->_controller->index();
    }
  }

  private function _loadDefaultController()
  {
    require 'controllers/index.php';
    $this->_controller = new Index();
    $this->_controller->index();
  }

  private function _loadExistingController()
  {
    $file = 'controllers/' . $this->_url[0] . '.php';
    if (file_exists($file)) {
      require $file;
      $this->_controller = new $this->_url[0];
      $this->_controller->loadModel($this->_url[0]);
    } else {
      $this->_error();
    }
  }

  private function _getUrl()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $this->_url = explode('/', $url);
  }

  private function _error() {
    require 'controllers/error_.php';
    $this->_controller = new Error_();
    $this->_controller->index();
    exit;
  }

}
