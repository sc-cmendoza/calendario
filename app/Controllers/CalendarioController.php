<?php

require_once(__DIR__ . '/../domain/month.php');
require_once(__DIR__ . '/../domain/calendar.php');

class CalendarioController {

    function render(string $startDate, string $endDate, int $columns){
        $calendar = new Calendar();
        $months = $calendar->getMonths($startDate, $endDate);

        ob_start();

        foreach($months as $index => $month){
            $this->renderMonth($month);
        }

        $htmlMonths = ob_get_contents();

        ob_end_clean();

        require(__DIR__ . "/../../views/calendario.php");
    }

    function renderMonth(Month $month){
        $monthName = $month->getMonthName();
        $first = $month->weekFirstDay();
        $max = $month->days();
        $year = $month->getYear();
        $cursor = 0;
        require(__DIR__ . "/../../views/month_view.php");
    }
}