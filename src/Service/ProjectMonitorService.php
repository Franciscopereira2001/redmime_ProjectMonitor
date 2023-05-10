<?php

namespace App\Service;

use App\Model\ProjectMonitor;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\SerializerInterface;

class ProjectMonitorService
{
    private Client $client;

    private SerializerInterface $serializer;

    public function __construct(string $projectMonitorUrl, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->client = new Client(['base_uri' => $projectMonitorUrl]);
    }

    /**
     * @return ProjectMonitor[]|array
     */
    public function getAllProjects(): array
    {
        $content = $this->client->get('')->getBody()->getContents();

//        $content = json_encode(array(
//            array(
//                "id" => 123435567,
//                "libelle" => "ddddgdfgfdd",
//                "actif" => true,
//                "description" => "",
//                "key" => "23456"
//            ),
//            array(
//                "id" => 87698954,
//                "libelle" => "dddhpuiludfgdfiluiluioldbd",
//                "actif" => true,
//                "description" => "",
//                "key" => "2928"
//            ),
//            array(
//                "id" => 109456876,
//                "libelle" => "hhhhlkkdgbdfblhiopihopyfyuioh",
//                "actif" => true,
//                "description" => "",
//                "key" => "567432"
//            ),
//            array(
//                "id" => 10945687869,
//                "libelle" => "temp1",
//                "actif" => true,
//                "description" => "",
//                "key" => "567432"
//            ),
//            array(
//                "id" => 10945687869,
//                "libelle" => "temp2",
//                "actif" => true,
//                "description" => "",
//                "key" => "5674382"
//            ),
//            array(
//                "id" => 12345678,
//                "libelle" => "newProjec;t1",
//                "actif" => true,
//                "description" => "",
//                "key" => "567i4324"
//            ),
//            array(
//                "id" => 12345678,
//                "libelle" => "newProçjecç;t2",
//                "actif" => true,
//                "description" => "",
//                "key" => "5674i3248"
//            )
//        ));

        return $this->serializer->deserialize(
            $content,
            ProjectMonitor::class."[]",
            "json"
        );
    }
}
