<?php

namespace System\Command;

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class ServeCommand extends Command
{
    protected $signature = 'serve';
    protected $description = 'Function For Starting Server';

    public function handle()
    {
        $url = explode(':', $_ENV['APP_URL']);
        $host = preg_replace('/^\/\//', '', $url[1]);
        $port = $url[2];

        $command = sprintf('php -S %s:%d -t %s', $host, $port, 'public');
        echo "Server is running on $host:$port";

        passthru($command);
    }
}
