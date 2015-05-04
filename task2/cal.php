#!/usr/bin/php5
<?php
$output = `clear`;
echo $output;
date_default_timezone_set('UTC');
$weekDays = array(1 => 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс');
$months = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
$currentMonth = date(n);
$currentYear = date(Y);
$currentDay = date(j);
$numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$firstDayOfMonth = date("N", mktime(0, 0, 0, $currentMonth, 1, $currentYear));
$lastDayOfMonth = date("N", mktime(0, 0, 0, $currentMonth, $numberDaysInMonth, $currentYear));
echo '      ' . $months[$currentMonth] . ' ' . $currentYear;
echo "\n";
foreach ($weekDays as $day){
    echo $day . ' ';
}
echo "\n";
for($i = 1; $i < (int)$firstDayOfMonth; $i++){
    echo '  ' , ' ';
}
$numDay = 1;
if((int)$firstDayOfMonth != 1){
    for($i = (int)$firstDayOfMonth; $i <= 7; $i++){
        if($numDay == (int)$currentDay){
            echo "\033[30;47m0$numDay\033[0m" . ' ';
        }else{
            echo '0' . $numDay . ' ';
        }
        ++$numDay;
    }
    echo "\n";
}
$j = 0;
for($i = $numDay; $i <= $numberDaysInMonth; $i++){
    if($i < 10){
        if($i == (int)$currentDay){
            echo "\033[30;47m0$i\033[0m" . ' ';
        }else{
            echo '0' . $i . ' ';
        }

    }else{
        if($i == (int)$currentDay){
            echo "\033[30;47m$i\033[0m" . ' ';
        }else{
            echo $i . ' ';
        }
    }
    ++$j;
    if($j == 7){
        echo "\n";
        $j = 0;
    }
}
if($j != 0){
    for($i = $j; $i <= 7; $i++){
        echo '  ' , ' ';
    }
}
echo "\n";
//var_dump($currentDay);
