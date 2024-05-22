<?php

function baseurl($path = null)
{

    return rtrim($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/" . $path, "/");
}

function asset($path = null)
{

    return baseurl('public/assets/' . $path);
}

function redirect($path = null)
{

    header("Location: " . baseurl($path));

    exit;
}
