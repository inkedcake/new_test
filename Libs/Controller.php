<?php

class Controller
{
    protected $view;
    protected $model;

    public function __construct() {
        $this->view = new View();
    }
    public function loadModel($name)
    {
        $path = 'Models/' . $name . '_model.php';
        if (file_exists($path)) {
            require 'Models/' . $name . '_model.php';
            $modelName = $name . '_model';
            $this->model = new $modelName();
        }
    }
}
