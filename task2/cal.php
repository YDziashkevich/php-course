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
$small = ncurses_newwin(14, 24, ($rows/2 - 14/2), ($cols/2 - 24/2));
//ncurses_keypad($small, TRUE);
ncurses_refresh();
ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
ncurses_wrefresh($small);
ncurses_end();
//echo $caledar->getCalendar();