<?php 

class Request {



    public static function url() {
            
        return trim(str_replace([dirname($_SERVER['SCRIPT_NAME']), basename($_SERVER['SCRIPT_NAME'])], null, $_SERVER['REQUEST_URI']), '/');
        
    }



    public static function method() {

        return $_SERVER['REQUEST_METHOD'];

    }

}