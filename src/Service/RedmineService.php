<?php

namespace App\Service;

use App\Model\ProjectMonitor;
use App\Model\Redmine;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RedmineService
{
    private $client;
    private $apiKey;
    private $redmineUrl;

    private $projectMonitorService;

    public function __construct(string $redmineUrl, string $redmineApiKey, ProjectMonitorService $projectMonitorService)
    {
        $this->apiKey = $redmineApiKey;
        $this->$redmineUrl = $redmineUrl;
        $this->client = new Client(['base_uri' => $redmineUrl]);
        $this->projectMonitorService = $projectMonitorService;
    }

    public function createProject(Redmine $redmine): array
    {
        try {
            $this->client->post('projects.json', [
                'headers' => [
                    'X-Redmine-API-Key' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'project' => [
                        'name' => $redmine->getName(),
                        'identifier'=> $redmine->getIdentifier(),
                        'description' => $redmine->getDescription(),
                        'is_public' => $redmine->getIsPublic(),
                    ],
                ],
            ]);

            return ["message" => sprintf("Objeto %s criado com sucesso.", $redmine->getIdentifier())];
        } catch (ClientException $exception) {
//            dd($exception->getMessage());
            return [
                "message" => sprintf("O projeto %s ja existe", $redmine->getIdentifier()),
                "error" => $exception->getCode()
            ];
//            return [
//                "messages" => $exception->getMessage(),
//                "error" => $exception->getCode()
//            ];
        }
    }

    public function createProjectMonitorProjectsInRedmine():array
    {
        //Obtem todos os projetos do Project Monitor
        $projects = $this->projectMonitorService->getAllProjects();

        $errors = [];

        /** @var ProjectMonitor $project */
        foreach ($projects as $project) {
            $redmineProject = new Redmine();

            $redmineProject->setName($project->getLibelle());
            $redmineProject->setDescription($project->getDescription());
            $redmineProject->setIdentifier($project->getKey());
            $redmineProject->setIsPublic($project->getActif());

            $redmineCreated = $this->createProject($redmineProject);

            if (isset($redmineCreated["error"])) {
                $errors[] = $redmineCreated;
            }
        }

        return ["message" => "Operacao concluida.", "errors" => $errors];
    }
}
