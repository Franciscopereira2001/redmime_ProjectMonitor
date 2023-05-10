<?php

namespace App\Controller;

use App\Service\RedmineService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    private RedmineService $redmineService;

    public function __construct(RedmineService $redmineService)
    {
        $this->redmineService = $redmineService;
    }

    public function createProject(): Response
    {
       $errors = $this->redmineService->createProjectMonitorProjectsInRedmine();

       return new Response(
           json_encode($errors),
           isset($errors["errors"]) ? Response::HTTP_BAD_REQUEST : Response::HTTP_CREATED
       );
    }
}
