<?php

namespace System;

abstract class Controller
{
    protected $variables = [];

    public function view(string $views, array $data = [])
    {

        $layout = $this->renderLayout();
        $output = $this->renderViewOnly($views, $data);
        $output = preg_replace('/\{\{ if (.*?) \}\}/', '<?php if ($1): ?>', $output);
        $output = preg_replace('/\{\{ else \}\}/', '<?php else: ?>', $output);
        $output = preg_replace('/\{\{ endif \}\}/', '<?php endif; ?>', $output);
        $output = preg_replace('/\{\{ foreach (.*?) \}\}/', '<?php foreach ($1): ?>', $output);
        $output = preg_replace('/\{\{ endforeach \}\}/', '<?php endforeach; ?>', $output);
        $output = replaceErrors($output);
        $output = preg_replace('/@error\((.*?)\)(.*?)@enderror/s', '', $output);
        $output = preg_replace('/@old\((.*?)\)/', '', $output);
        $output = preg_replace('/@echo\((.*?)\)/s', '<?php echo $1; ?>', $output);
        echo str_replace("{{content}}", $output, $layout);
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

    public function load($type, $class)
    {

        $loader = new Loader();
        $loader->load($type, $class);
    }
    public function input($name)
    {
        return  htmlspecialchars($_POST[$name]) ??  htmlspecialchars($_GET[$name]) ?? null;
    }
}
