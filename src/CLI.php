<?php
namespace Atlas;

use Atlas\Commands\NewCommand;
use Atlas\Commands\ServeCommand;

class CLI
{
    public static function run(array $argv = [])
    {
        if (count($argv) < 2) {
            self::help();
            exit(1);
        }

        $command = $argv[1];

        switch ($command) {
            case "new":
                (new NewCommand())->handle($argv);
                break;
            case "serve":
                (new ServeCommand())->handle($argv);
                break;
            case "help":
            default:
                self::help();
                break;
        }
    }

    private static function help()
    {
        echo "Atlas CLI - A lightweight PHP framework\n";
        echo "Usage: atlas [command] [options]\n\n";
        echo "Commands:\n";
        echo "  new              Create a new project (choose template)\n";
        echo "  serve            Start the development server\n";
        echo "  help             Shows this help message\n";
    }
}
