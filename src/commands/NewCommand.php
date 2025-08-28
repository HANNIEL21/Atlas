<?php
namespace Atlas\Commands;

use Atlas\Templates\WebTemplate;
use Atlas\Templates\ApiTemplate;
use Atlas\Templates\MinimalTemplate;

class NewCommand
{
    public function handle(array $argv)
    {
        echo "Available templates:\n";
        echo "  - web\n";
        echo "  - api\n";
        echo "  - minimal\n\n";

        echo "Template: ";
        $template = strtolower(trim(fgets(STDIN)));

        echo "Project Name: ";
        $projectName = trim(fgets(STDIN));
        $projectPath = getcwd() . DIRECTORY_SEPARATOR . $projectName;

        switch ($template) {
            case "web":
                (new WebTemplate())->generate($projectPath, $projectName);
                break;
            case "api":
                (new ApiTemplate())->generate($projectPath, $projectName);
                break;
            case "minimal":
                (new MinimalTemplate())->generate($projectPath, $projectName);
                break;
            default:
                echo "❌ Invalid template. Please choose: web, api, or minimal.\n";
        }
    }
}
