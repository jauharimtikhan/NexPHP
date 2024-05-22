<?php

namespace System\Command;


class Console
{
    protected $commands = [];

    public function __construct()
    {
        $this->loadCommands();
    }

    protected function loadCommands()
    {
        $this->commands = [
            'make:controller' => \System\Command\CoreCommand::class,
            'serve' => \System\Command\ServeCommand::class,
            'make:model' => \System\Command\ModelCommand::class,
            // Tambahkan command lain di sini
        ];
    }

    public function run($argv)
    {
        $commandName = $argv[1];
        $arguments = $this->parseArguments(array_slice($argv, 2));

        if (isset($this->commands[$commandName])) {
            $commandClass = $this->commands[$commandName];
            $command = new $commandClass($arguments);
            $command->handle();
        } else {
            echo "Command not found: $commandName\n";
        }
    }

    protected function parseArguments($args)
    {
        $parsed = [];
        foreach ($args as $arg) {
            if (strpos($arg, '=') !== false) {
                list($key, $value) = explode('=', $arg, 2);
                $parsed[$key] = $value;
            }
        }
        return $parsed;
    }
}
