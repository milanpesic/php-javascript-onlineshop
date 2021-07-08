<?php

class Token extends Controller {


    
    public static function generated($token) {

        return $_SESSION[$token] = bin2hex(openssl_random_pseudo_bytes(32));

    }



    public static function check($token) {

        if(!empty($_POST[$token])) {

                if(hash_equals($_SESSION[$token], $_POST[$token])) {

                    unset($_SESSION[$token]);

                    return true;

                } 
    
            } 

        return false;

    }

}