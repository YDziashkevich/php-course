#!/usr/bin/php5
<?php
echo `clear`;
date_default_timezone_set('UTC');
require_once 'autoloader.php';
//ncurses
$caledar = new Calendar();
$ncurse = ncurses_init();
$fullscreen = ncurses_newwin(0, 0, 0, 0);
$small = ncurses_newwin(14, 24, 5, 10);
ncurses_refresh();
ncurses_mvwaddstr($small, 0, 0, $caledar->getCalendar());
ncurses_wrefresh($small);
ncurses_end();
//echo $caledar->getCalendar();