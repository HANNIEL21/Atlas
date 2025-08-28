<?php
namespace Atlas\Templates;

class ApiTemplate
{
    public static function generate(string $projectPath, string $projectName): void
    {
        // Create directories
        mkdir($projectPath, 0777, true);
        mkdir("$projectPath/public", 0777, true);
        mkdir("$projectPath/src", 0777, true);
        mkdir("$projectPath/src/Controllers", 0777, true);

        // index.php (simple API router)
        $indexContent = <<<PHP
        <?php
        header("Content-Type: application/json");

        \$uri = trim(\$_SERVER['REQUEST_URI'], '/');

        if (\$uri === '' || \$uri === 'api') {
            echo json_encode([
                "message" => "Welcome to $projectName API",
                "status" => "success"
            ]);
        } elseif (\$uri === 'api/users') {
            echo json_encode([
                "users" => [
                    ["id" => 1, "name" => "Alice"],
                    ["id" => 2, "name" => "Bob"]
                ]
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                "error" => "Endpoint not found"
            ]);
        }
        PHP;

        file_put_contents("$projectPath/public/index.php", $indexContent);

        // composer.json
        $composer = [
            "name" => strtolower($projectName) . "/api",
            "description" => "An Atlas API project.",
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
        $readme = "# $projectName API\n\nGenerated with Atlas CLI (api template).\n";
        file_put_contents("$projectPath/README.md", $readme);

        // .gitignore
        $gitignore = "/vendor/\n.env\n/node_modules/\n";
        file_put_contents("$projectPath/.gitignore", $gitignore);

        echo "✅ API project '$projectName' created successfully!\n";
        echo "Next steps:\n";
        echo "  cd $projectName\n";
        echo "  composer install\n";
        echo "  php atlas serve\n";
    }
}
