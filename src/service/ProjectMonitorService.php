<?php

namespace App\service;

use Doctrine\ORM\EntityManagerInterface;
use App\Model\ProjectMonitor;

class ProjectMonitorService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllProjects(): array
    {

//        $projectMonitorUrl = 'https://pmiredmine2.free.beeceptor.com/projects';
//
//        $jsonContent = file_get_contents($projectMonitorUrl);
//
//        // Descodifica o JSON em um array associativo
//        $jsonArray = json_decode($jsonContent, true);
//



        $repository = $this->entityManager->getRepository(ProjectMonitor::class);

        return $repository->findAll();

    }
}
