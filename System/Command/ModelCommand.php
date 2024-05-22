<?php

namespace System\Command;

class ModelCommand extends Command
{
    protected $signature = 'make:model {name}';
    protected $description = 'Function For Creating Model';

    public function handle()
    {
        $name = $this->argument('name');

        $filePath = dirname(__DIR__, 2) . '/App/Models/' . $name . '.php';
        $fileContent = $fileContent = <<<PHP
        <?php
        namespace App\Models;

        use System\Database\Database;

        class $name extends Database
        {
            public function __construct()
            {
                // Constructor
            }
        
            // Tambahkan method dan properti sesuai kebutuhan
        }
        
        PHP;

        file_put_contents($filePath, $fileContent);
        echo "Model $name created successfully.\n";
    }
}
