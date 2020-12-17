<?php 

class Router {

    private $_routesMap = array();
    private $_middlewares = array();

    private function generateRouteKey($route, $method){
        return "$route-$method";
    }

    // Routes registers

    function get($route, $callBack){
        $this->configureRoute($route, 'GET', $callBack);
    }

    function post($route, $callBack){
        $this->configureRoute($route, 'POST', $callBack);
    }

    // **

    function listen(){

        $route = $this->getRoute();
        $method = $_SERVER['REQUEST_METHOD'];
        $params = $this->getParams();
        $body = $this->getBody();
        $json = $this->getJson();
        $from = $_SERVER['REMOTE_ADDR'];
        $date = $_SERVER['REQUEST_TIME'];

        $request = new Request($route,$method, $params, $body, $json, $from, $date);

        foreach ($this->_middlewares as $index => $_middleware) {
            $_middleware($request);
        }

        if(!$this->routeExist($route, $method)){
            require(__DIR__ . '/../../views/404.php');
            return;
        }

        $this->getRouteCallBack($route ,$method)($request, new Response());

        
    }

    function addMiddleware($middleware){
        $this->_middlewares[] = $middleware;
    }

    private function routeExist($route ,$method){
        return array_key_exists($this->generateRouteKey($route, $method), $this->_routesMap);
    }

    private function getRouteCallBack($route ,$method){
        return $this->_routesMap[$this->generateRouteKey($route, $method)];
    }

    private function configureRoute($route ,$method, $callBack){
        $this->_routesMap[$this->generateRouteKey($route, $method)] = $callBack;
    }

    private function getParams(){
        $params = $_GET;
        $result = array();

        foreach($params as $key => $value ){
            $result[$key] = $value;
        }
        return $result;
    }

    private function getBody(){
        $body = $_POST;
        $result = array();

        foreach($body as $key => $value ){
            $result[$key] = $value;
        }
        return $result;
    }

    private function getJson(){
        $result = array();
        if($this->getRequestMethod() !== 'POST') {
            return $result;
        }
        if(empty($_SERVER["CONTENT_TYPE"])){
            return $result;
        }
        if($_SERVER["CONTENT_TYPE"] != 'application/json'){
            return $result;
        }

        $inputContent = trim(file_get_contents("php://input"));

        $result = json_decode($inputContent);

        return $result;
    }

    private function getRequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    private function getRoute(){
        $uri = $_SERVER['REQUEST_URI'];
        $route = "/";

        $paramsStartIndex = strpos($uri,'?');

        if($paramsStartIndex == false){
            $route = $uri;
            return $route;
        }

        $route = substr($uri, 0, $paramsStartIndex);
        return $route;
    }
}

class Request {

    private $_route;
    private $_method;
    private $_params;
    private $_body;
    private $_json;
    private $_from;
    private $_date;

    function __construct($route, $method, $params, $body, $json, $from, $date){
        $this->_route = $route;
        $this->_method = $method;
        $this->_params = $params;
        $this->_body = $body;
        $this->_json = $json;
        $this->_from = $from;
        $this->_date = $date;
    }

    public function __get($property) {
        switch($property) {
            case 'route':
                return $this->_route;
            case 'method':
                return $this->_method;
            case 'params':
                return $this->_params;
            case 'body':
                return $this->_body;
            case 'json':
                return $this->_json;
            case 'from':
                return $this->_from;
            case 'date':
                return $this->_date;
            break;
        }
    }
}

class Response {
    private $_statusCode = 200;

    function setStatusCode(int $code){
        $_statusCode = $code;
    }

    function send(array $data){
        http_response_code($this->_statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}