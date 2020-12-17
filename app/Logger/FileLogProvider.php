<?php
require_once(__DIR__ . '/LogProvider.php');

class FileLogProvider implements LogProvider{

    private $_filePath;

    function __construct(string $filePath){
        $this->_filePath = $filePath;
    }
    
    function log(string $data){
        $file = fopen($this->_filePath, "a") or die("Unable to open file!");
        $txt = "$data\n";
        fwrite($file, $txt);
        fclose($file);
    }
}