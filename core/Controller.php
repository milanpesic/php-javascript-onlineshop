<?php

  class Controller {
      

    public function view($name, $data = []) {

        if(file_exists("views/{$name}.php")){

            extract($data);

            require "views/{$name}.php";

        } else {

            exit('VIEW DOES NOT EXIST');

        }
        
    }

    
    public function escape($string) {

        return htmlentities($string, ENT_QUOTES, "UTF-8");

    }


    public function request($data) {

        if(!empty($_POST[$data])) {

            return $this->escape($_POST[$data]);

        }
        
    } 

}