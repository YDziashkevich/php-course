#!/usr/bin/php5
<?php

define('WIDTH_CAL', 24);
define('HEIGHT_CAL', 17);
define('EXIT_KEY', 27);

echo `clear`;
date_default_timezone_set('UTC');
require_once 'autoloader.php';

$calendar = new Calendar();
$ncurse = ncurses_init();
ncurses_clear();
ncurses_curs_set(0);
$fullscreen = ncurses_newwin(0, 0, 0, 0);
ncurses_getmaxyx($fullscreen, $rows, $cols);
$winCal = ncurses_newwin(HEIGHT_CAL, WIDTH_CAL, ($rows/2 - (int)17/2), ($cols/2 - 24/2));

ncurses_refresh();
ncurses_mvwaddstr($winCal, 0, 0, $calendar->getCalendar());
ncurses_wrefresh($winCal);
ncurses_curs_set(0);
ncurses_noecho();
$getSymbol = ncurses_getch($winCal);
while($getSymbol != EXIT_KEY){
    switch($getSymbol){
        case NCURSES_KEY_LEFT:
            $calendar->prevMonth();
            ncurses_mvwaddstr($winCal, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($winCal);
            break;
        case NCURSES_KEY_RIGHT:
            $calendar->nextMonth();
            ncurses_mvwaddstr($winCal, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($winCal);
            break;
        case NCURSES_KEY_DOWN:
            $calendar->prevYear();
            ncurses_mvwaddstr($winCal, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($winCal);
            break;
        case NCURSES_KEY_UP:
            $calendar->nextYear();
            ncurses_mvwaddstr($winCal, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($winCal);
            break;

    }
    $getSymbol = ncurses_getch($winCal);
}
ncurses_end();