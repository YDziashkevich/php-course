#!/usr/bin/php5
<?php
echo `clear`;
date_default_timezone_set('UTC');
require_once 'autoloader.php';

$calendar = new Calendar();
$ncurse = ncurses_init();
$fullscreen = ncurses_newwin(0, 0, 0, 0);
ncurses_getmaxyx($fullscreen, $rows, $cols);
$small = ncurses_newwin(17, 24, ($rows/2 - (int)17/2), ($cols/2 - 24/2));

$calendar->setPic($small);

ncurses_refresh();
ncurses_mvwaddstr($small, 0, 0, $calendar->getCalendar());
ncurses_wrefresh($small);
ncurses_curs_set(0);
ncurses_noecho();
$y = ncurses_getch($small);
while($y != 27){
    switch($y){
        case NCURSES_KEY_LEFT:
            $calendar->prevMonth();
            ncurses_mvwaddstr($small, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_RIGHT:
            $calendar->nextMonth();
            ncurses_mvwaddstr($small, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_DOWN:
            $calendar->prevYear();
            ncurses_mvwaddstr($small, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($small);
            break;
        case NCURSES_KEY_UP:
            $calendar->nextYear();
            ncurses_mvwaddstr($small, 0, 0, $calendar->getCalendar());
            ncurses_wrefresh($small);
            break;

    }
    $y = ncurses_getch($small);
}
ncurses_end();