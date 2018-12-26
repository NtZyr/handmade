<?php

namespace Core;

class Storage
{
    protected static $storage_dir = '/storage/';

    public $file;

    public function __construct($model, $field)
    {
        $table = $model::$table;
        $file = $_FILES[$field]['name'];
        $uploadfile = dirname(__DIR__) . static::$storage_dir . "$table/$file";
        if (move_uploaded_file($_FILES[$field]['tmp_name'], $uploadfile)) {
            $this->file = $file;
            return $this;
        }
    }

    public static function get($model, $img)
    {
        $table = $model::$table;

        return static::$storage_dir . "$table/$img";
    }
}