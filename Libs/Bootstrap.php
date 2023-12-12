<?php
class Bootstrap
{
    public function __construct() {
        $url = $_SERVER['REQUEST_URI'];

        if ($url) {
            $url = explode('/', trim($url, '/'));
        } else {
            $url[0] = [];
        }
        
        if (empty($url[0])) {
            require  'Controllers/registerController.php';
            $controller = new Register();
            $controller->index();
            exit;
        }
        
        $file = 'Controllers/' . $url[0] . 'Controller.php';
        
        if (file_exists($file)) {
            require $file;
        
            $class_name = $url[0];
            $controller = new $class_name();
            $controller->loadModel($url[0]);
        
            $action = isset($url[1]) ? $url[1] : 'index';
        
            if (method_exists($controller, $action)) {
                if (isset($url[2])) {
                    $controller->{$action}($url[2]);
                } else {
                    $controller->{$action}();
                }
            } else {
                echo '404';
            }
        } else {
            echo '404';
        }
    }
}
