<?php

use Core\Routing\Route as Route;
use Core\Routing\Router as Router;

Router::get(new Route('/', 'HomeController@index'));
Router::get(new Route('/catalog', 'ProductController@index'));
Router::run();