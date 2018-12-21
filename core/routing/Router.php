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
        // get $_SERVER['REQUEST_URI'] and get it parts
        $request_uri = array_key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '/';
        $uri_blocks = explode('/', $request_uri);

        // get all routes urls
        foreach (self::$_routes[$_SERVER['REQUEST_METHOD']] as $url => $callback) {
            // get route url and get it parts
            $url_blocks = explode('/', $url);

            // matching 
            if (count($uri_blocks) == count($url_blocks)) {
                if ($uri_blocks[count($uri_blocks) - 2] == $url_blocks[count($url_blocks) - 2]) {
                    foreach ($url_blocks as $block) {
                        if (preg_match('/\{(.*?)\}/', $block, $variable)) {
                            $block_num = array_search($variable[0], $url_blocks);
                            if ($block_num) {
                                $vars[$url_blocks[$block_num]] = $uri_blocks[$block_num];
                                unset($url_blocks[$block_num]);
                                unset($uri_blocks[$block_num]);
                            }

                            $uri = implode('/', $uri_blocks);
                            if ($uri == '') {
                                $uri = '/';
                            }
                            $url = implode('/', $url_blocks);
                            if ($url == '') {
                                $url = '/';
                            }
                            $url = '/^' . str_replace('/', '\\/', $url) . '$/';

                            if (preg_match($url, $uri, $matches)) {
                                array_shift($matches);
                                call_user_func_array($callback, $vars);
                                return;
                            }
                        }
                    }
                }
            }
        }





        // $path = array_key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '/';
        // $path_blocks = explode('/', $path);

        // foreach (self::$_routes[$_SERVER['REQUEST_METHOD']] as $url => $callback) {
        //     $url_blocks = explode('/', $url);

        //     foreach ($url_blocks as $block) {
        //         if (preg_match('/\{(.*?)\}/', $block, $variable)) {
        //             $block_num = array_search($variable[0], $url_blocks);

        //             if ($block_num) {
        //                 $vars[$url_blocks[$block_num]] = $path_blocks[$block_num];
        //                 unset($url_blocks[$block_num]);
        //                 unset($path_blocks[$block_num]);
        //             }
        //         }
        //     }

        //     $path = implode('/', $path_blocks);
        //     if ($path == '') {
        //         $path = '/';
        //     }
        //     $url = implode('/', $url_blocks);
        //     if ($url == '') {
        //         $url = '/';
        //     }
        //     $url = '/^' . str_replace('/', '\\/', $url) . '$/';

        //     if (preg_match($url, $path, $matches)) {
        //         array_shift($matches);
        //         call_user_func_array($callback, $vars);
        //         return;
        //     }
        // }
    }
}