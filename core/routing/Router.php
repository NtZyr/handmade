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

        $uri_blocks = explode('/', $requestUri);
        $vars = [];

        foreach ($routes as $url => $callback) {
            $url_blocks = explode('/', $url);

            foreach ($url_blocks as $key => $block) {
                if (preg_match('/\{(.*?)\}/', $block, $var)) {
                    $block_num = array_search($var[0], $url_blocks);
                }
            }
            if (isset($block_num)) {
                if (($block_num == count($uri_blocks) - 1 || $block_num == count($uri_blocks))
                    && isset($url_blocks[$block_num - 1])
                    && isset($uri_blocks[$block_num - 1])
                    && $url_blocks[$block_num - 1] === $uri_blocks[$block_num - 1]) {
                    if (isset($url_blocks[$block_num])
                        && isset($uri_blocks[$block_num])) {
                        $vars[$url_blocks[$block_num]] = $uri_blocks[$block_num];
                    }
                    $_callback = $callback;
                }
            }
        }

        return self::action($_callback, $vars);
    }
}