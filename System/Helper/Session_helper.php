<?php

function session()
{
    global $session;
    return $session;
}

function session_put($key, $value)
{
    session()->put($key, $value);
}

function session_get($key, $default = null)
{
    return session()->get($key, $default);
}

function session_has($key)
{
    return session()->has($key);
}

function session_forget($key)
{
    session()->forget($key);
}

function session_flush()
{
    session()->flush();
}

function session_flash($key, $value)
{
    global $session;
    $session->flash($key, $value);
}

function session_get_flash($key, $default = null)
{
    global $session;
    return $session->getFlash($key, $default);
}
