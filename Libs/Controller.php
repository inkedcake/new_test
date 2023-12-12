<?php
/**
 * Created by PhpStorm.
 * User: InkedCake
 * Date: 18.08.2020
 * Time: 22:08
 */

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