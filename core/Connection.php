<?php

class Connection {



    protected static $instance = null;

    

    protected function __construct() {}

    protected function __clone() {}




    public static function instance()  {

        if (self::$instance === null) {

            $config = Config::instance();

            $options = [
                PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                
                self::$instance = new PDO($config['database']['dsn'], $config['database']['user'], $config['database']['password'], $options);

            } catch (\PDOException $e) {

                throw new \PDOException($e->getMessage(), (int)$e->getCode());       

            }

        }

        return self::$instance;

    }

    public static function __callStatic($method, $args) {

        return call_user_func_array(array(self::instance(), $method), $args);
        
    }
}
