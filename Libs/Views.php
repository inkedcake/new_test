<?php
class View {
    protected $data;

    public function __construct() {
    }
    public function render($name, $noInclude = false) {
        if($noInclude == true) {
            require 'Views/'.$name.'.php';
              } else {
            require 'Views/header.php';
            require 'Views/'.$name.'.php';
        }
    }

    function assign($key, $val) {
       return $this->data[$key] = $val;
    }
}
?>