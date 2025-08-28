<?php
namespace Atlas\Templates;

class MinimalTemplate
{
    public static function generate(string $projectPath, string $projectName): void
    {
        // Create directories
        mkdir($projectPath, 0777, true);
        mkdir("$projectPath/public", 0777, true);
        mkdir("$projectPath/src", 0777, true);

        // index.php (super simple)
        $indexContent = <<<PHP
        <?php
        echo "Hello from $projectName (Minimal Template)!";
        PHP;

        file_put_contents("$projectPath/public/index.php", $indexContent);

        // composer.json
        $composer = [
            "name" => strtolower($projectName) . "/minimal",
            "description" => "A minimal Atlas project.",
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
        $readme = "# $projectName (Minimal Template)\n\nGenerated with Atlas CLI.\n";
        file_put_contents("$projectPath/README.md", $readme);

        // .gitignore
        $gitignore = "/vendor/\n.env\n/node_modules/\n";
        file_put_contents("$projectPath/.gitignore", $gitignore);

        echo "✅ Minimal project '$projectName' created successfully!\n";
        echo "Next steps:\n";
        echo "  cd $projectName\n";
        echo "  composer install\n";
        echo "  php atlas serve\n";
    }
}
