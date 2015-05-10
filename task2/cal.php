#!/usr/bin/php5
<?php
echo `clear`;
date_default_timezone_set('UTC');
require_once 'autoloader.php';
//ncurses
$caledar = new Calendar();
$ncurse = ncurses_init();
$fullscreen = ncurses_newwin(0, 0, 0, 0);
ncurses_getmaxyx($fullscreen, $rows, $cols);
$small = ncurses_newwin(16, 24, ($rows/2 - 16/2), ($cols/2 - 24/2));
//ncurses_keypad($small, TRUE);
ncurses_refresh();
ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
ncurses_wrefresh($small);
ncurses_curs_set(0);
//ncurses_noecho();
$y = ncurses_getch($small);
while($y != 27){
    switch($y){
        case NCURSES_KEY_LEFT:
            $caledar->prevMonth();
            ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_RIGHT:
            $caledar->nextMonth();
            ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_DOWN:
            $caledar->prevYear;
            ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_UP:
            $caledar->nextYear;
            ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
            ncurses_wrefresh($small);
            break;
            //ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
            //ncurses_wrefresh($small);
        var_dump($y);
    }
    $y = ncurses_getch($small);

}
ncurses_end();
//echo $caledar->getCalendar();