<?php
class Calendar
{
    private $month;
    private $year;
    private $day;
    protected $weekDays ='Пн Вт Ср Чт Пт Сб Вс';
    protected $months = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
    private $currentMonth;
    private $currentYear;
    private $currentDay;
    protected $border = '|';

    public function __construct()
    {
        $this->month = (int)date("n");
        $this->currentMonth = $this ->month;
        $this->year = (int)date("Y");
        $this->currentYear = $this->year;
        $this->day = (int)date("j");
        $this->currentDay = $this->day;
    }

    private function dataMonth()
    {
        $numberDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $firstDay = date("N", mktime(0, 0, 0, $this->month, 1, $this->year));
        $lastDay = date("N", mktime(0, 0, 0, $this->month, $numberDays, $this->year));
        return $dataMonth = array('numberDays' => (int)$numberDays, 'firstDay' => (int)$firstDay, 'lastDay' => (int)$lastDay);
    }
    public function nextMonth()
    {
        ++ $this->month;
        if($this->month > 12){
            $this->month = 1;
        }
    }
    public function prevMonth()
    {
        -- $this->month;
        if($this->month < 1){
            $this->month = 12;
        }
    }
    public function nextYear()
    {
        ++ $this->year;
    }
    public function prevYear()
    {
        -- $this->year;
    }

    private function delimiter()
    {
        $delimiter = '';
        for($i = 1; $i <= 24; $i++){
            $delimiter .= '-';
        }
        return $delimiter;
    }

    private function getNavigation()
    {
        $navigation = '';//"\n";
        $navigation .= '| влево -М / +М вправо |';
        //$navigation .= "\n";
        $navigation .= $this->delimiter();
        //$navigation .= "\n";
        $navigation .= '| вверх -Г  /  +Г вниз |';
        //$navigation .= "\n";
        $navigation .= $this->delimiter();
        /*for($i = 1; $i <= 3; $i++){
            $navigation .= "\n";
        }*/
        $navigation .= '|      esc - выход     |';
        $navigation .= $this->delimiter();
        return $navigation;
    }

    public function getCalendar()
    {
        $calendar = '';
        $calendar = $calendar . '        ' . $this->months[$this->month] . ' ' . $this->year . "\n";
        $calendar = $calendar . $this->delimiter()/*. "\n"*/;
        $calendar = $calendar . $this->border . ' ' . $this->weekDays . ' ' . $this->border /*. "\n"*/;
        $calendar = $calendar . $this->delimiter()/*. "\n"*/;
        $calendar = $calendar . $this->border . ' ';
        $dataMonth = $this->dataMonth();
        for($i = 1; $i < $dataMonth['firstDay']; $i++){
           $calendar = $calendar . '  ' . ' ';
        }
        $numDay = 1;
        if($dataMonth['firstDay'] != 1){
            for($i = $dataMonth['firstDay']; $i <= 7; $i++){
                /*
                if($numDay == $this->currentDay &&  $this->currentMonth == $this ->month && $this->currentYear == $this->year){
                    $calendar = $calendar . "\033[30;47m $numDay\033[0m" . ' ';
                }else{
                    $calendar = $calendar . ' ' . $numDay . ' ';
                }*/
                $calendar = $calendar . ' ' . $numDay . ' ';/////
                ++$numDay;
            }
            $calendar = $calendar . $this->border /*. "\n"*/;
        }
        $calendar = $calendar . $this->border . ' ';
        $j = 0;
        for($i = $numDay; $i <= $dataMonth['numberDays']; $i++){
            if($i < 10){
                /*
                if($i == $this->currentDay &&  $this->currentMonth == $this ->month && $this->currentYear == $this->year){
                    $calendar = $calendar . "\033[30;47m $i\033[0m" . ' ';
                }else{
                    $calendar = $calendar . ' ' . $i . ' ';
                }*/$calendar = $calendar . ' ' . $i . ' ';
            }else{/*
                if($i == $this->currentDay &&  $this->currentMonth == $this ->month && $this->currentYear == $this->year){
                    $calendar = $calendar . "\033[30;47m$i\033[0m" . ' ';
                }else{
                    $calendar = $calendar . $i . ' ';
                }*/
                $calendar = $calendar . $i . ' ';
            }
            ++$j;
            if($j == 7){
                $calendar = $calendar . $this->border /*. "\n"*/;
                if($i != $dataMonth['numberDays']){
                    $calendar = $calendar . $this->border . ' ';
                }
                $j = 0;
            }
        }
        if($j != 0){
            for($i = $j; $i <= 7; $i++){
               $calendar = $calendar . '  ' . ' ';
            }
        }
        $calendar = $calendar . $this->delimiter();
        $calendar .= $this->getNavigation();
        return $calendar;
    }
}
