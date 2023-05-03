<?php

namespace App\Controller;

use App\model\ProjectMonitor;
use App\model\Redmine;
use App\service\RedmineService;
use App\service\ProjectMonitorService;


class ApiController
{


    private $projectMonitorService;
    private $redmineService;

    public function __construct(ProjectMonitorService $projectMonitorService, RedmineService $redmineService)
    {
        $this->projectMonitorService = $projectMonitorService;
        $this->redmineService = $redmineService;
    }

    public function createProjectMonitorProjectsInRedmine()
    {
        //Obtem todos os projetos do Project Monitor
        $projects = $this->projectMonitorService->getAllProjects();

        foreach ($projects as $project) {
            $redmineProject = new Redmine();
            $redmineProject->setName($project->getLibelle());
            $redmineProject->setDescription($project->getDescription());
            $redmineProject->setIdentifier($project->getKey());
            $redmineProject->setIsPublic($project->getActif());


            $redmineProject = $this->redmineService->createProject($project);

        }
    }


}
