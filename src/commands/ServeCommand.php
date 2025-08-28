<?php
namespace Atlas\Commands;

class ServeCommand
{
    public function handle(array $argv)
    {
        $host = "127.0.0.1";
        $port = 8000;

        $publicDir = getcwd() . "/public";

        if (!is_dir($publicDir)) {
            echo "Error: No public directory found. Are you inside a project?\n";
            return;
        }

        echo "🚀 Starting development server at http://$host:$port\n";
        echo "Press Ctrl+C to stop.\n";

        passthru("php -S $host:$port -t $publicDir");
    }
}
