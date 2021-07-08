
<?php


class Cookie {


        public static function has($name) {

            return !empty($_COOKIE[$name]) ? true : false;

        }


        public static function get($name) {

            return $_COOKIE[$name];

        }


        public static function put($name, $value, $expiry) {

            if(setcookie($name, $value, time() + $expiry, '/')) {

                return true;

            }

            return false;
        
        }


        public static function remove($name) {

            self::put($name, '', time() - 1);

        }

}