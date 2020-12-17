<?php

require_once("../app/domain/month.php");
require_once("../app/Http/Router.php");

require_once('../app/Controllers/CalendarioController.php');


// LOGS
require_once('../app/Controllers/LoggerController.php');
require_once("../app/Logger/FileLogProvider.php");
require_once("../app/Logger/LogProvider.php");

date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX");


//Configure logger
$fileLogger = new FileLogProvider( __DIR__ . '/calendario/access_log.txt' );
$logController = new LoggerController($fileLogger);


//Configure Router
$router = new Router();

$router->get('/calendario/', function (Request $req, Response $res){
    require(__DIR__ . '/../views/formulario.php');
});

$router->get('/calendario/access_log/', function (Request $req, Response $res){
    $fh = fopen(__DIR__ . '/../calendario/access_log.txt', 'r');
    $pageText = fread($fh, 25000);
    echo nl2br($pageText);
});

$router->post('/calendario/', function (Request $req, Response $res){

    $fechaInicio = $req->body['fecha_inicio'];
    $fechaFin = $req->body['fecha_fin'];
    $columns = $req->body['columns'];

    $calendarioController = new CalendarioController();
    $calendarioController->render($fechaInicio, $fechaFin, $columns);
});

$router->addMiddleware(function (Request $req)use ($logController){
    if($req->route == '/calendario/' && $req->method == "POST"){

        $fechaInicio = $req->body['fecha_inicio'];
        $fechaFin = $req->body['fecha_fin'];

        $dateOfRequest = date('d/M/Y', $req->date);
        $hourOfRequest = date('H:i:s', $req->date);

        $text = "$dateOfRequest - $hourOfRequest - $req->from - $fechaInicio - $fechaFin";
        $logController->log($text);
        
    }
});

$router->listen();

// 

// $m = new Month(12,2020);
// $m2 = new Month(11,2019);
// $m3 = new Month(10,2019);


// echo($m->render());

// echo($m2->render());

// echo($m3->render());
