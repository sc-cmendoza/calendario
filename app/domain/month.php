<?php

class Month {

    private $_month;
    private $_year;

    function __construct($mont, $year){
        $this->_month = $mont;
        $this->_year = $year;
    }

    function getMonthName(){
        return ucfirst(strftime("%B", $this->timeStamp()));
    }

    function getYear(){
        return $this->_year;
    }

    function weekFirstDay(){
        return date("w", $this->timeStamp());
    }

    function timeStamp(){
        return mktime(12,0,0,$this->_month, 1, $this->_year);
    }

    function days(){
        return date('t', mktime(0, 0, 0, $this->_month, 1, $this->_year));
    }

}