<?php

function baseurl($path = null)
{

    $httpHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    $urlParts = parse_url($httpHost);
    $httpProtocol = isset($urlParts['scheme']) ? $urlParts['scheme'] : 'http';
    $host = $httpProtocol . "://" . $_SERVER['HTTP_HOST'] . "/" . $path;

    return $host;
}

function asset($path = null)
{

    return baseurl('public/assets/' . $path);
}

function redirect($path = null)
{
    header("Location: " . $path);
    exit;
}
