<?php
require_once(__DIR__ . "/../Logger/LogProvider.php");

class LoggerController {

    private $_logger;

    function __construct(LogProvider $logger){
        $this->_logger = $logger;
    }

    function log(string $data){
        $this->_logger->log($data);
    }
}