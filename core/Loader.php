<?php

namespace Core;

class Loader
{
    public static function models()
    {
        $models_dir = dirname(__DIR__) . '/models/';
        $models = array_diff(scandir($models_dir), array('..', '.'));

        foreach ($models as $model) {
            require $models_dir . $model;
        }
    }

    public static function controllers()
    {
        $controllers_dir = dirname(__DIR__) . '/controllers/';
        $controllers = array_diff(scandir($controllers_dir), array('..', '.'));

        foreach ($controllers as $controller) {
            require $controllers_dir . $controller;
        }
    }
}