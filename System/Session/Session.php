<?php

namespace System\Session;

class Session
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_set_cookie_params(
                $this->config['lifetime'] * 60,
                $this->config['path'],
                $this->config['domain'],
                $this->config['secure'],
                $this->config['httponly']
            );

            if (isset($this->config['same_site'])) {
                session_set_cookie_params(['samesite' => $this->config['same_site']]);
            }

            session_start();
        }
    }

    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function forget($key)
    {
        unset($_SESSION[$key]);
    }

    public function flush()
    {
        session_unset();
    }

    public function regenerate($destroy = false)
    {
        session_regenerate_id($destroy);
    }

    public function flash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
        $_SESSION['flash_new'][$key] = true;
    }

    public function getFlash($key, $default = null)
    {
        if (isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $value;
        }
        return $default;
    }
    public function hasFlash($key)
    {
        return isset($_SESSION['flash'][$key]);
    }

    private function removeFlashData()
    {
        if (isset($_SESSION['flash_new'])) {
            foreach ($_SESSION['flash_new'] as $key => $value) {
                if (!$value) {
                    unset($_SESSION['flash'][$key]);
                }
            }
            unset($_SESSION['flash_new']);
        }
        if (isset($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $key => $value) {
                $_SESSION['flash_new'][$key] = false;
            }
        }
    }

    public  function set_old($data)
    {
        $_SESSION['old_input'] = $data;
        $_SESSION['old_input_new'] = true;
    }

    public function getOld($key, $default = NULL)
    {

        if (isset($_SESSION['old_input'][$key])) {

            return htmlspecialchars($_SESSION['old_input'][$key], ENT_QUOTES, 'UTF-8');
        }
        return $default;
    }
}
