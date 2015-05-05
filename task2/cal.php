#!/usr/bin/php5
<?php
echo `clear`;
date_default_timezone_set('UTC');
$weekDays = array(1 => 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс');
$months = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
$currentMonth = date("n");
$currentYear = date("Y");
$currentDay = date("j");
$numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$firstDayOfMonth = date("N", mktime(0, 0, 0, $currentMonth, 1, $currentYear));
$lastDayOfMonth = date("N", mktime(0, 0, 0, $currentMonth, $numberDaysInMonth, $currentYear));
echo "\033[8;27H";
// месяц, год
echo '        ' . $months[$currentMonth] . ' ' . $currentYear;
echo "\n";
echo "\033[9;27H";
for($i = 1; $i <= 24; $i++){
	echo '-';
}
echo "\n";
echo "\033[10;27H";
//дни недели
echo '| ';
foreach ($weekDays as $day){
    echo $day . ' ';
}
echo '|';
echo "\n";
echo "\033[11;27H";
// первая неделя месяца
for($i = 1; $i <= 24; $i++){
	echo '-';
}
echo "\n";
echo "\033[12;27H";
echo '| ';
for($i = 1; $i < (int)$firstDayOfMonth; $i++){
    echo '  ' , ' ';
}
$numDay = 1;
if((int)$firstDayOfMonth != 1){
    for($i = (int)$firstDayOfMonth; $i <= 7; $i++){
        if($numDay == (int)$currentDay){
            echo "\033[30;47m $numDay\033[0m" . ' ';
        }else{
            echo ' ' . $numDay . ' ';
        }
        ++$numDay;
    }
	echo '|';
    echo "\n";
}
//оставшиеся дни месяца
$j = 0;
echo "\033[13;27H";
echo '| ';
$indent = 14;
for($i = $numDay; $i <= $numberDaysInMonth; $i++){
    if($i < 10){
        if($i == (int)$currentDay){
            echo "\033[30;47m $i\033[0m" . ' ';
        }else{
            echo ' ' . $i . ' ';
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
		echo '|';
        echo "\n";
		echo "\033[$indent;27H";
		if($i != $numberDaysInMonth){
			echo '| ';
		}
		++$indent;		
        $j = 0;
    }
}
if($j != 0){
    for($i = $j; $i <= 7; $i++){
        echo '  ' , ' ';
    }
}
for($i = 1; $i <= 24; $i++){
	echo '-';
}
echo "\n";
echo "\033[$indent;27H";
echo '| влево -М / +М вправо |';
echo "\n";
++$indent;
echo "\033[$indent;27H";
for($i = 1; $i <= 24; $i++){
	echo '-';
}
echo "\n";
++$indent;
echo "\033[$indent;27H";
echo '| вверх -Г  /  +Г вниз |';
echo "\n";
++$indent;
echo "\033[$indent;27H";
for($i = 1; $i <= 24; $i++){
	echo '-';
}
for($i = 1; $i <= 5; $i++){
	echo "\n";
}
//var_dump($currentDay);
