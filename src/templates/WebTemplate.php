<?php

namespace Atlas\Templates;

class WebTemplate
{
    public static function generate(string $projectPath, string $projectName): void
    {
        // Create directories
        mkdir($projectPath, 0777, true);
        mkdir("$projectPath/public", 0777, true);
        mkdir("$projectPath/src", 0777, true);

        // index.php (with simple router)
        $indexContent = <<<PHP
        <?php
        // Simple Router Example
        \$uri = trim(\$_SERVER['REQUEST_URI'], '/');

        if (\$uri === '' || \$uri === 'home') {
            echo "Welcome to $projectName Web App!";
        } elseif (\$uri === 'about') {
            echo "This is the about page.";
        } else {
            http_response_code(404);
            echo "404 - Page not found.";
        }
        PHP;

        file_put_contents("$projectPath/public/index.php", $indexContent);

        // composer.json
        $composer = [
            "name" => strtolower($projectName) . "/app",
            "description" => "An Atlas Web project.",
            "type" => "project",
            "require" => new \stdClass(),
            "autoload" => [
                "psr-4" => [
                    ucfirst($projectName) . "\\\\" => "src/"
                ]
            ]
        ];

        file_put_contents(
            "$projectPath/composer.json",
            json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        // README.md
        $readme = "# $projectName Web App\n\nGenerated with Atlas CLI (web template).\n";
        file_put_contents("$projectPath/README.md", $readme);

        // .gitignore
        $gitignore = "/vendor/\n.env\n/node_modules/\n";
        file_put_contents("$projectPath/.gitignore", $gitignore);

        echo "✅ Web project '$projectName' created successfully!\n";
        echo "Next steps:\n";
        echo "  cd $projectName\n";
        echo "  composer install\n";
        echo "  php atlas serve\n";
    }
}
