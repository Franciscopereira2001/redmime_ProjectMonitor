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
//        $response = $this->client->get('');
////        echo "--->".$this->getAllProjects();
////        exit;
//
//        //Descodifica o json em um array associativo
//        $arr = json_decode($response->getBody()->getContents());
//        return is_array($arr) ? $arr:[];

        $arr = array(
            array(
                "id" => 123435567,
                "libelle" => "ddddgdfgfdd",
                "actif" => true,
                "description" => "",
                "key" => "23456"
            ),
            array(
                "id" => 87698954,
                "libelle" => "dddhpuiludfgdfiluiluioldbd",
                "actif" => true,
                "description" => "",
                "key" => "2928"
            ),
            array(
                "id" => 109456876,
                "libelle" => "hhhhlkkdgbdfblhiopihopyfyuioh",
                "actif" => true,
                "description" => "",
                "key" => "567432"
            ),
            array(
                "id" => 10945687869,
                "libelle" => "temp1",
                "actif" => true,
                "description" => "",
                "key" => "567432"
            ),
            array(
                "id" => 10945687869,
                "libelle" => "temp2",
                "actif" => true,
                "description" => "",
                "key" => "5674382"
            ),
            array(
                "id" => 12345678,
                "libelle" => "newProjec;t1",
                "actif" => true,
                "description" => "",
                "key" => "567i4324"
            ),
            array(
                "id" => 12345678,
                "libelle" => "newProçjecç;t2",
                "actif" => true,
                "description" => "",
                "key" => "5674i3248"
            )


        );

        return is_array($arr) ? $arr:[];
    }
}
