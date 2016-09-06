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

// returning all info about juices
$app->get('/juice', function (Request $request, Response $response) use ($app) {
    $this->logger->addInfo("Reading from AV_juice table");
    $mapper = new SQLTools($this->db); // $this is Slim app Obj
    $result = $mapper->getJuice();
    try{
        $response = $response->withJson($result);
        return $response;
    } catch (Exception $e){
        echo $e->getMessage();
    }
});

// returning juices of special brand
$app->get('/juice/{brand}', function (Request $request, Response $response) use ($app) {
    $this->logger->addInfo("Getting " . $request->getAttribute('brand') . "from av_juice table");
    $mapper = new SQLTools($this->db); // $this is Slim app Obj
    $result = $mapper->getJuice($request->getAttribute('brand'));
    try {
        $response = $response->withJson($result);
        return $response;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});

// returning all brands
$app->get('/brands', function (Request $request, Response $response) use ($app) {
    $this->logger->addInfo("Getting all brands from av_juice table");
    $mapper = new SQLTools($this->db); // $this is Slim app Obj
    $result = $mapper->getBrands();
    try {
        $response = $response->withJson($result);
        return $response;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});