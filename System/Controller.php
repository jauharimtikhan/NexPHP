<?php

namespace System;

abstract class Controller
{
    protected $variables = [];

    public function view(string $views, array $data = [])
    {

        $layout = $this->renderLayout();
        $view = $this->renderViewOnly($views, $data);

        echo str_replace("{{content}}", $view, $layout);
    }
    private function renderLayout()
    {
        ob_start();
        include_once Application::$ROOT_DIR . '/App/Views/Layouts/main.layout.php';
        return ob_get_clean();
    }

    private function renderViewOnly($view, $data = [])
    {

        extract($data);
        ob_start();
        include_once Application::$ROOT_DIR . "/App/Views/Pages/$view.php";

        return ob_get_clean();
    }

    public function model($model)
    {
        return new $model();
    }

    public function input($name)
    {

        return  htmlspecialchars($_POST[$name]) ??  htmlspecialchars($_GET[$name]) ?? null;
    }

    public function load($type, $class)
    {

        $loader = new Loader();
        $loader->load($type, $class);
    }
}
