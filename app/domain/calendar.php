<?php

require_once(__DIR__ . '/month.php');

class Calendar{
    function getMonths(string $startDate, string $endDate){
        $result = [];

        $datePointer = $this->timeStamp($startDate);
        $maxDate = $this->timeStamp($endDate);
        $maxDate = strtotime("+1 month", $maxDate);
        
        while($datePointer < $maxDate){
            $month = date("m", $datePointer);
            $year = date("Y", $datePointer);
            $result[] = new Month($month, $year);
            $datePointer = strtotime("+1 month", $datePointer);
        }

        return $result;

    }

    function timeStamp(string $date){

        $dateMonthAndYear = explode ( '-', $date );

        $month = $dateMonthAndYear[0];
        $year = $dateMonthAndYear[1];
        
        return mktime(12,0,0,$month, 1, $year);
    }
}