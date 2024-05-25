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

function session_set_validation(array $value)
{
    global $session;
    $session->flash('errors', $value);
}

function session_has_validation($key)
{
    global $session;
    return $session->hasFlash($key);
}

function old($key, $default = '')
{
    return session()->getOld($key, $default);
}

function clear_old_input()
{
    unset($_SESSION['old_input']);
}

function save_old_input($data)
{
    global $session;
    $session->set_old($data);
}
