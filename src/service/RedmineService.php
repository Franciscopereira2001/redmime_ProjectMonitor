<?php

namespace App\service;

use App\model\ProjectMonitor;
use App\model\Redmine;
use App\service\ProjectMonitorService;
use GuzzleHttp\Client;

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

//        echo "--->".$this->redmineUrl;
//        exit;
        $response = $this->client->post('projects.json', [
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

        return json_decode($response->getBody()->getContents(), true)['project'];
    }

    public function createProjectMonitorProjectsInRedmine():array
    {
        //Obtem todos os projetos do Project Monitor
        $projects = $this->projectMonitorService->getAllProjects();
        $returnedData = [];
        foreach ($projects as $project) {

            $redmineProject = new Redmine();
            $redmineProject->setName($project->getLibelle);
            $redmineProject->setDescription($project->getDescription);
            $redmineProject->setIdentifier($project->getKey);
            $redmineProject->setIsPublic($project->getActif);
//
//            $redmineProject->setName($project->libelle);
//            $redmineProject->setDescription($project->description);
//            $redmineProject->setIdentifier($project->key);
//            $redmineProject->setIsPublic($project->actif);

            $returnedData[] = $redmineProject;
        }

        foreach ($returnedData as $project) {
            $result  = $this->createProject($project);
        }

        return $returnedData;
    }
}