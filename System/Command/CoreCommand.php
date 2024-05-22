<?php

namespace System\Command;

class CoreCommand extends Command
{
    protected $signature = 'make:controller {name}';
    protected $description = 'Function For Creating Controller';

    public function handle()
    {
        $name = $this->argument('name');

        $filePath = dirname(__DIR__, 2) . '/App/Controller/' . $name . '.php';
        $fileContent = $fileContent = <<<PHP
        <?php
        
        namespace App\Controller;
        use System\Controller;
        class $name extends Controller
        {
            public function __construct()
            {
                // Constructor
            }
        
            // Tambahkan method dan properti sesuai kebutuhan
        }
        
        PHP;

        file_put_contents($filePath, $fileContent);
        echo "Controller $name created successfully.\n";
    }
}
