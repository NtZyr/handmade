<?php

namespace Core\Routing;

class Router
{
    const GET = 'GET';
    const POST = 'POST';

    private static $_routes = [
        'GET' => array(),
        'POST' => array(),
    ];

    public static function add(Route $route, $method)
    {
        switch ($method) {
            case 'GET':
                self::$_routes['GET'][$route->getURL()] = $route->getCallback();
                break;
            case 'POST':
                self::$_routes['POST'][$route->getURL()] = $route->getCallback();
                break;
            default:
                exit('ERROR!');
                break;
        }
    }

    public static function get(Route $route)
    {
        self::add($route, self::GET);
    }

    public static function post(Route $route)
    {
        self::add($route, self::POST);
    }

    public static function run()
    {
        $path = array_key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '/';

        foreach (self::$_routes[$_SERVER['REQUEST_METHOD']] as $url => $callback) {
            if (preg_match($url, $path, $matches)) {
                array_shift($matches);
                call_user_func_array($callback, array_values($matches));
                return;
            }
        }
    }
}