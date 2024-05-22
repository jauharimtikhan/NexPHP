<?php

namespace System;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $postion = strpos($path, '?');
        if ($postion === false) {
            return $path;
        }
        return substr($path, 0, $postion);
    }
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function matchUri($routeUri, $requestUri)
    {
        $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $routeUri);
        return preg_match("#^$pattern$#", $requestUri);
    }
}
