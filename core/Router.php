<?php


class Router {



    public static $routes = [

        'GET' => [],
        'POST' => []

    ];


    public static function get($pattern, $callback) {

        self::$routes['GET'][self::route($pattern)] = $callback;

    }


    public static function post($pattern, $callback) {
        
        self::$routes['POST'][self::route($pattern)] = $callback;

    }


    public static function route($pattern) {

       $pattern = strtr($pattern, ['{url}' => '([0-9a-zA-Z]+)', '{id}' => '([0-9]+)', '{slug}' => '([0-9a-zA-Z-]+)', '{sort}' => '([0-9a-zA-Z-?=&]+)']);

       $pattern = '@^' . $pattern . '$@';

       return $pattern;

    }


    public static function routeNotFound() {

        return Redirect::to('404');
        
    }


    public static function routeHasFound($requestMethod, $url) {

        foreach (self::$routes[$requestMethod] as $pattern => $callback) {

            list($controller, $method) = explode('@', $callback);

                if(preg_match($pattern, $url, $parameters)) {

                    array_shift($parameters);

                    if(method_exists($controller, $method)) {

                        return call_user_func_array([new $controller, $method], $parameters);

                    } else {

                        exit("Something went wrong, check if $controller has method $method");

                    }

                }  

        } 

        return self::routeNotFound(); 

    }


    public static function execute() {

        return self::routeHasFound(Request::method(), Request::url());

    }

}