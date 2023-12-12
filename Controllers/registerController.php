<?php

class Register extends Controller {
    public function __construct() {
        parent::__construct();
    }
   public function index() {
        $this->view->render('register/index');
    }
    public function run() {
        $this->model->run();
    }
}
