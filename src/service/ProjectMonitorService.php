<?php

namespace App\service;


use App\model\ProjectMonitor;
use GuzzleHttp\Client;


class ProjectMonitorService
{

    private $client;
    private $url;

    public function __construct(string $projectMonitorUrl)
    {
        $this->url = $projectMonitorUrl;
        $this->client = new Client(['base_uri' => $projectMonitorUrl]);
    }
    public function getAllProjects(): array
    {
        $response = $this->client->get('');
//        echo "--->".$this->getAllProjects();
//        echo "--->".$this->getAllProjects();
//        exit;

        //Descodifica o json em um array associativo
        $arr = json_decode($response->getBody()->getContents());

        return is_array($arr) ? $arr:[];


    }
}
