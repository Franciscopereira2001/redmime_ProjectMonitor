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
                "id" => 810008,
                "libelle" => "dfldbjg[egbmpgf[mbpgbmgfbpkplfgkbmd",
                "actif" => true,
                "description" => "",
                "key" => "8106qaj0707708dfk"
            ),
            array(
                "id" => 810018,
                "libelle" => "0014a-DSISynergie RHCadrag4e & appel d'offres",
                "actif" => true,
                "description" => "",
                "key" => "871000088"
            ),
            array(
                "id" => 815678,
                "libelle" => "new3fdlksdadlmkdsfk;nmvkle;dfsproject",
                "actif" => true,
                "description" => "",
                "key" => "871000088"
            )
        );

        return is_array($arr) ? $arr:[];
    }
}
