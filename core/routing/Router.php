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

    public static function action($callback, $vars = null)
    {
        if ($vars === null) $vars = [];
        return call_user_func_array($callback, $vars);
    }

    public static function run()
    {
        $uri = explode('?', $_SERVER["REQUEST_URI"]);
        $requestUri = urldecode(rtrim(reset($uri), '/'));
        $routes = self::$_routes[$_SERVER['REQUEST_METHOD']];

        if (isset($routes[$requestUri])) {
            $_callback = $routes[$requestUri];
            return self::action($_callback);
        }

        $uri_array = explode('/', $requestUri);
        $vars = [];

        foreach ($routes as $url => $callback) {
            $url_array = preg_split('/\:/', $url);
            $uri = substr($requestUri, 0, strrpos($requestUri, '/', 0) + 1) ? : '/';
            if ($url_array[0] == $uri) {
                $value = substr($requestUri, strlen($url_array[0]));
                $var[$url_array[1]] = $value;
                $_callback = $callback;
                return self::action($_callback, $var);
            }
        }
    }
}