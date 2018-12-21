<?php

use Core\Routing\Route as Route;
use Core\Routing\Router as Router;

Router::get(new Route('/{slug}', 'PageController@show'));
Router::get(new Route('/category/{slug}', 'CategoryController@show'));
Router::get(new Route('/product/{id}', 'ProductController@show'));
Router::get(new Route('/order/{id}', 'OrderController@show'));
Router::get(new Route('/signup', 'UserController@register'));
Router::post(new Route('/signup', 'UserController@create'));
Router::run();