<?php

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'work_test');
define('DB_USER', 'my_root');
define('DB_PASS', '');

class Database extends PDO {
    public function __construct() {
        parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    }
}
