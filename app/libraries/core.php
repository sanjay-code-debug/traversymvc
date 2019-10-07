<?php
/**
 * App Core Class
 * Creates URL & loads core controller
 * URL Format: /controller/method/params
 */
class Core {
    protected $currentControllerName = 'Pages';
    protected $currentMethodName = 'index';
    protected $params = [];
    protected $currentController;
    protected $currentMethod;

    public function __construct() {
        // print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in controllers for first value
        if (file_exists('../app/controllers/' 
            . ucwords($url[0]) . '.php')) {
            // If exists, set as controller
            $this->currentControllerName = ucwords($url[0]);
            
            // Unset 0 Index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' 
            . $this->currentControllerName . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentControllerName;
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
