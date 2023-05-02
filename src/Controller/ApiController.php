<?php

namespace App\Controller;

//use http\Client;
use Symfony\Component\HttpClient\HttpClient;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ApiController
{
    /**
     * @Route("/create-project", name="create_project")
     */
    public function createProject(Request $request): Response
    {
        // Get the project data from the request
        $projectData = $request->request->all();



        $projectMonitorUrl = 'https://pmiredmine2.free.beeceptor.com/projects';

        $jsonContent = file_get_contents($projectMonitorUrl);

        // Verifica se a requisição foi bem-sucedida
        if ($jsonContent === false) {
            die('Erro ao fazer a requisição GET para a URL');
        }

        // Descodifica o JSON em um array associativo
        $jsonArray = json_decode($jsonContent, true);

// Verifica se a decodificação do JSON foi bem-sucedida
        if ($jsonArray === null) {
            die('Erro ao decodificar o JSON');
        }

        //$jsonString = json_encode($jsonArray, JSON_PRETTY_PRINT); // Converte o array em formato JSON
        //echo $jsonString;


        foreach ($jsonArray as $projeto) {
//            $projetoId = $projeto['id']; // Acessa o valor do campo 'id' do projeto
//            $projetoLibelle = $projeto['libelle']; // Acessa o valor do campo 'libelle' do projeto
//            $projetoActif = $projeto['actif']; // Acessa o valor do campo 'actif' do projeto
//            $projetoDescription = $projeto['description']; // Acessa o valor do campo 'description' do projeto
//            $projetoKey = $projeto['key']; // Acessa o valor do campo 'key' do projeto

            // Cria um array associativo com os campos
            $projetoArray = array(
                'name' => $projeto['libelle'],
                'identifier' => $projeto['id'],
                'description' =>  $projeto['description'],
                'is_public' => $projeto['actif'],

            );


            //Call the Redmine API to create a new project
            $redmineUrl = 'http://localhost:8080/projects.json';
            $redmineApiKey = '8674bbc6ec8ce1d8089ec32dda507db288ff4542';
            //$httpClient = HttpClient::create();
            $httpClient = HttpClient::create();
            $response = $httpClient->request('POST', $redmineUrl, [
                'auth_basic' => [$redmineApiKey, ''],
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode(['project' => $projetoArray]),
            ]);

        }


// Get the new project ID from the Redmine response
        //$redmineResponse = json_decode($response->getContent(), true);
        //$projectId = $redmineResponse['project']['id'];
// Call the ProjectMonitor API to create a new project
        //$projectMonitorUrl =
            //'https://pmiredmine2.free.beeceptor.com/projects';
       // $projectMonitorApiKey = 'your-projectmonitor-api-key';
        //$httpClient = HttpClient::create();
        //$response = $httpClient->request('GET', $projectMonitorUrl);

        // Return the response from the ProjectMonitor API
        return new Response($response->getContent());
    }


}
