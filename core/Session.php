
<?php


class Session {



        public static function has($name) {

            return !empty($_SESSION[$name]) ? true : false;

        }


        public static function set($name) {

            return $_SESSION[$name];

        }


        public static function put($name, $value) {

            return $_SESSION[$name] = $value;

        }


        public static function get($name, $message = null) {

            if(self::has($name)) {

                    $session = self::set($name);

                    self::remove($name);

                    return $session;

            } else {

                    self::put($name, $message);

            }

        }


        public static function remove($name) {

            if(self::has($name)) {

                unset($_SESSION[$name]);

            }

        }

}