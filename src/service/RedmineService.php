<?php

namespace App\service;

use App\model\ProjectMonitor;
use App\model\Redmine;
use App\service\ProjectMonitorService;
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

    public function createProject(Redmine $redmine)
    {

//        echo "--->".$this->redmineUrl;
//        exit;
//        dd($redmine);
        try {
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
        foreach ($projects as $project) {

            $redmineProject = new Redmine();

            //usado quando e para obter os dados de um array
            $redmineProject->setName($project["libelle"]);
            $redmineProject->setDescription($project["description"]);
            $redmineProject->setIdentifier($project["key"]);
            $redmineProject->setIsPublic($project["actif"]);

//            usado quando e para ler de um objeto
//            $redmineProject->setName($project->libelle);
//            $redmineProject->setDescription($project->description);
//            $redmineProject->setIdentifier($project->key);
//            $redmineProject->setIsPublic($project->actif);

            $return = $this->createProject($redmineProject);

            if (isset($return["error"])) {
                $errors[] = $return;
            }
        }

        return ["message" => "Operacao concluida.", "errors" => $errors];
    }
}