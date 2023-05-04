<?php

namespace App\Controller;

use App\model\ProjectMonitor;
use App\model\Redmine;
use App\service\RedmineService;
use App\service\ProjectMonitorService;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends AbstractController
{
    private $redmineService;


    public function __construct(RedmineService $redmineService)
    {
        $this->redmineService = $redmineService;
    }

    public function randomName()
    {
       $projects = $this->redmineService->createProjectMonitorProjectsInRedmine();

       return new Response(json_encode($projects),200);
    }


}
