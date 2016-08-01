<?php
// Routes


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../Classes/SQLTools.php';


//default home page
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Default Page');

    return $response;
});

// returning all info from any table in database
$app->get('/{table}', function (Request $request, Response $response) use ($app) {
    $this->logger->addInfo("Reading table " . $request->getAttribute('table'));
    $mapper = new SQLTools($this->db); // $this is Slim app Obj
    $result = $mapper->getAll($request->getAttribute('table'));
    try{
        $response = $response->withJson($result);
        return $response;
    } catch (Exception $e){
        echo $e->getMessage();
    }
});

// returning all users' names from selected country
$app->get('/country/{countryName}', function (Request $request, Response $response) use ($app) {
    $this->logger->addInfo("Getting users' names from " . $request->getAttribute('countryName'));
    $mapper = new SQLTools($this->db); // $this is Slim app Obj
    $result = $mapper->getUsersFromCountry($request->getAttribute('countryName'));
    if (count($result) != 0) {
        try{
            $response = $response->withJson($result);
            return $response;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    } else {
        echo "There is no user from " . $request->getAttribute('countryName');
    }
});