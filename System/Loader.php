<?php

namespace System;

class Loader
{

    public function __construct()
    {
    }

    public function load(string $type, $class)
    {
        if ($type === 'library') {
            if (class_exists($class)) {
                return new $class;
            } else {
                throw new \Exception("The class $class not found");
            }
        } elseif ($type === 'helper') {
            if (class_exists($class)) {
                return new $class;
            } else {
                throw new \Exception("The class $class not found");
            }
        } else {
            throw new \Exception("The type of loader is not valid");
        }
    }
}
