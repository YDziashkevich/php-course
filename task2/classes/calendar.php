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
    private $pic;

    public function __construct()
    {
        $this->month = (int)date("n");
        $this->currentMonth = $this ->month;
        $this->year = (int)date("Y");
        $this->currentYear = $this->year;
        $this->day = (int)date("j");
        $this->currentDay = $this->day;
    }

    public function setPic($pic)
    {
        $this->pic = $pic;
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
            $this->year ++;
        }
    }
    public function prevMonth()
    {
        -- $this->month;
        if($this->month < 1){
            $this->month = 12;
            $this->year --;
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

    protected function getNavigation()
    {
        $navigation = '';
        $navigation .= '| <- -Месяц / +Месяц ->|';
        $navigation .= $this->delimiter();
        $navigation .= '|вниз -Год /+Год вверх |';
        $navigation .= $this->delimiter();
        $navigation .= '|      esc - выход     |';
        $navigation .= $this->delimiter();
        return $navigation;
    }

    protected function getMonthYear()
    {
        $monthYear = $this->months[$this->month] . ' ' . $this->year;
        $lengthString = strlen(' ' . $this->year) + strlen($this->months[$this->month]) / 2;
        $start = (24 - $lengthString) / 2;
        $header = '';
        for($i = 1; $i <= (int)$start; $i ++){
            $header = $header . ' ';
        }
        $header .= $monthYear;
        for($i = ((int)$start + $lengthString + 1); $i <= 24; $i ++){
            $header = $header . ' ';
        }
        return $header;
    }

    public function getCalendar()
    {
        $dataMonth = $this->dataMonth();
        $calendar = $this->getMonthYear();
        $calendar = $calendar . $this->delimiter();
        $calendar = $calendar . $this->border . ' ' . $this->weekDays . ' ' . $this->border;
        $calendar = $calendar . $this->delimiter();
        $calendar = $calendar . $this->border . ' ';
        if($dataMonth['firstDay'] != 1){
            for($i = 1; $i < $dataMonth['firstDay']; $i++){
                $calendar = $calendar . '  ' . ' ';
            }
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
            $calendar = $calendar . $this->border;
        }
        if($dataMonth['firstDay'] != 1){
            $calendar = $calendar . $this->border . ' ';
        }
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
                $calendar = $calendar . $this->border;
                if($i != $dataMonth['numberDays']){
                    $calendar = $calendar . $this->border . ' ';
                }
                $j = 0;
            }
        }
        if($j != 0){
            for($i = $j; $i < 7; $i++){
               $calendar = $calendar . '  ' . ' ';
            }
            $calendar .= $this->border;
        }
        $calendar = $calendar . $this->delimiter();
        $calendar .= $this->getNavigation();
        $calendar .= '                        ';
        return $calendar;
    }
}