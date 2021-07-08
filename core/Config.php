<?php

class Config {


    protected static $instance = null;
    

    public static function instance()  {

        if (self::$instance === null) {

            //self::$instance = parse_ini_file('./config.ini');

            self::$instance = include('./configuration.php');

        }

        return self::$instance;

    }
    
}