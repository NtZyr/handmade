<?php

namespace Core\Routing;

use InvalidArgumentException;

class Route
{
    private $_url;
    private $_callback;

    public function __construct($url, $callback)
    {
        $this->_setURL($url);

        if (is_callable($callback)) {
            $this->_callback = $callback;
            return;
        }

        try {
            $this->_setCallback($callback);
        } catch (InvalidArgumentException $e) {
            var_dump($this->_setCallback($callback));
            exit('Error!');
        }
    }

    protected function _setCallback($callback)
    {
        $callback = (string)$callback;
        $aCallback = explode('@', $callback);

        if (is_callable($callback)) {
            $this->_callback = $callback;
        } else if (count($aCallback) == 2 && file_exists('controllers/' . $aCallback[0] . '.php')) {
            require_once 'controllers/' . $aCallback[0] . '.php'; // instead of including the class you can make usage of http://php.net/manual/en/function.spl-autoload-register.php
            $this->_callback[0] = new $aCallback[0];
            $this->_callback[1] = $aCallback[1];
            // $this->_callback = $aCallback;
        } else {
            throw new InvalidArgumentException('$callback is invalid.');
        }
    }

    public function _setURL($url)
    {
        $this->_url = '/^' . str_replace('/', '\\/', $url) . '$/';
    }

    public function getURL()
    {
        return $this->_url;
    }

    public function getCallback()
    {
        return $this->_callback;
    }
}