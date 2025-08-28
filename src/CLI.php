<?php
namespace Atlas;

class CLI {
    public static function run(array $argv = []) {
        // Remove the first item (the script name "bin/atlas")
        $args = array_slice($argv, 1);

        if (empty($args)) {
            self::showHelp();
            return;
        }

        $command = $args[0] ?? 'help';

        switch ($command) {
            case 'new':
                echo "Creating a new project...\n";
                // Later we’ll handle template setup here
                break;

            case 'serve':
                echo "Starting development server...\n";
                // Could map to PHP's built-in server
                break;

            case 'help':
            default:
                self::showHelp();
                break;
        }
    }

    private static function showHelp() {
        echo "Atlas CLI - A lightweight PHP framework\n";
        echo "Usage: atlas [command] [options]\n\n";
        echo "Commands:\n";
        echo "  new [name]       Create a new project\n";
        echo "  serve            Start the development server\n";
        echo "  help             Shows help message\n";
    }
}
