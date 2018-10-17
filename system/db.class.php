<?php

/**
 * Just a custom PDO class
 * as an example of autoloading
 * classes and registering services.
 */
class Db extends PDO {

    public function __construct() {
        $dsn = sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_DBAS);
        parent::__construct($dsn, DB_USER, DB_PASS);
    }
}
